<?php

namespace App\Http\Controllers\Admin;

use App\Dosen;
use App\Http\Controllers\Controller;
use App\Penelitian;
use App\PenelitianReviewer;
use App\Pengabdian;
use App\RefSkema;
use App\Reviewer;
use App\TahapanReview;
use App\Usulan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class PlottingReviewerController extends Controller
{
    public function index(){
        abort_if(Gate::denies('plotting_reviewer_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $tahapanRiview = TahapanReview::where('tahun', Carbon::now()->year)
            ->pluck('nama','id');
        $skemas = RefSkema::all()
            ->pluck('nama', 'id');

        $tahapans = TahapanReview::all();
        $penelitian = Penelitian::with(['usulanAnggotumWithPenelitianId' => function($query)
        {
            $query->where('jabatan', 1);
        }])->select('id as penelitian_id','judul')->get();

        $penelitian = $penelitian->each(function ($p){
           $p->peneliti = $p->usulanAnggotumWithPenelitianId[0]->dosen->nama;
        });

        $tahapans = $tahapans->crossJoin($penelitian)->map(function ($item,$key) {
            $tahapan = $item[0]->toArray();
            $penelitian = $item[1]->toArray();
            $tahapanPenelitian = collect($tahapan)->mergeRecursive($penelitian);
            return $tahapanPenelitian;
        });

        $plottedReviewer = PenelitianReviewer::all();
        $jumlahReviewerMax = $tahapans->pluck('jumlah_reviewer')->max();

        return view('admin.plottingReviewers.index',compact('tahapanRiview','skemas','tahapans','plottedReviewer','jumlahReviewerMax'));
    }

    public function filter(Request $request){
        abort_if(Gate::denies('plotting_reviewer_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $tahapanRiview = TahapanReview::where('tahun', Carbon::now()->year)
            ->pluck('nama','id');
        $skemas = RefSkema::all()
            ->pluck('nama', 'id');

        $skema = RefSkema::findOrFail($request->skema);

        $tahapans = TahapanReview::where('id',$request->tahapan)->get();
        if($skema->jenis_usulan == Usulan::PENELITIAN) {
            $penelitian = Penelitian::with(['usulanAnggotumWithPenelitianId' => function ($query) {
                $query->where('jabatan', 1);
            }])->select('id as penelitian_id', 'judul', 'skema_id')->get()->filter(function ($value) use ($request) {
                return $value->skema_id == $request->skema;
            });

            $penelitian = $penelitian->each(function ($p) {
                $p->peneliti = $p->usulanAnggotumWithPenelitianId[0]->dosen->nama;
            });

            $tahapans = $tahapans->crossJoin($penelitian)->map(function ($item, $key) {
                $tahapan = $item[0]->toArray();
                $penelitian = $item[1]->toArray();
                $tahapanPenelitian = collect($tahapan)->mergeRecursive($penelitian);
                return $tahapanPenelitian;
            });
            $tahapan_id = $request->tahapan;
            $skema_id = $request->skema;

            $plottedReviewer = PenelitianReviewer::all();
            $jumlahReviewerMax = $tahapans->pluck('jumlah_reviewer')->max();

            return view('admin.plottingReviewers.index',compact('tahapanRiview','skemas','tahapans','plottedReviewer','jumlahReviewerMax','tahapan_id','skema_id'));
        }else if($skema->jenis_usulan == Usulan::PENGABDIAN){
            $penelitian = Pengabdian::with(['usulanAnggotumWithPengabdianId' => function ($query) {
                $query->where('jabatan', 1);
            }])->select('id as pengabdian_id', 'judul', 'skema_id')->get()->filter(function ($value) use ($request) {
                return $value->skema_id == $request->skema;
            });

            $penelitian = $penelitian->each(function ($p) {
                $p->peneliti = $p->usulanAnggotumWithPengabdianId[0]->dosen->nama;
            });

            $tahapans = $tahapans->crossJoin($penelitian)->map(function ($item, $key) {
                $tahapan = $item[0]->toArray();
                $penelitian = $item[1]->toArray();
                $tahapanPenelitian = collect($tahapan)->mergeRecursive($penelitian);
                return $tahapanPenelitian;
            });

            $tahapan_id = $request->tahapan;
            $skema_id = $request->skema;

            $plottedReviewer = PenelitianReviewer::all();
            $jumlahReviewerMax = $tahapans->pluck('jumlah_reviewer')->max();

            return view('admin.plottingReviewers.index_pengabdian',compact('tahapanRiview','skemas','tahapans','plottedReviewer','jumlahReviewerMax','tahapan_id','skema_id'));
        }

    }

    public function plotReviewer(Request $request){
        $permission = Gate::denies('plotting_reviewer_manage');
        if ($permission){
            return ['error' => 'access denied'];
        }
        $response = PenelitianReviewer::create([
            'usulan_id' => $request->usulan_id,
            'tahapan_review_id' => $request->tahapan_review_id,
            'reviewer_id' => $request->reviewer_id
        ]);
        return ['dosen' => $response->reviewer->dosen, 'plot_id' => $response->id];
    }

    public function deletePlotReviewer($id){
        $permission = Gate::denies('plotting_reviewer_manage');
        if ($permission){
            return ['error' => 'access denied'];
        }
        $penlitianReviewer = PenelitianReviewer::findOrFail($id);
        $penlitianReviewer->delete();
        return ['success' => 'data reviewer berhasil dihapus'];
    }

    public function getReviewer($tahapan_review_id, $usulan_id){
        $plot = PenelitianReviewer::where('tahapan_review_id',$tahapan_review_id)
            ->where('usulan_id',$usulan_id)->pluck('reviewer_id');
        $reviewer = Reviewer::pluck('id');
        $dosen = Dosen::whereIn('id',$reviewer)
            ->whereNotIn('id', $plot)
            ->pluck('nama','id');

        return $dosen;
    }

    public function rekapitulasi(){
        abort_if(Gate::denies('plotting_reviewer_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $reviewers = Reviewer::all();
        return view('admin.plottingReviewers.rekapitulasi',compact('reviewers'));
    }
}
