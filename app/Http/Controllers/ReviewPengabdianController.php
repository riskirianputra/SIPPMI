<?php

namespace App\Http\Controllers;

use App\Pengabdian;
use App\RefSkema;
use App\RefSkemaQuestion;
use App\Review;
use App\ReviewPenilaian;
use App\TahapanReview;
use App\Usulan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ReviewPengabdianController extends Controller
{
    //
    public function index()
    {
        abort_if(Gate::denies('review'), Response::HTTP_FORBIDDEN, 403);

        $usulans = collect([]);

        if (session()->has('review_params')) {
            $params = session()->get('review_params');
            $skema = RefSkema::find($params['skema']);
            if($skema->jenis_usulan == Usulan::PENGABDIAN) {
                $usulans = $this->_filter($params['tahapan'], $params['skema']);
            }
        }

        $user_id = auth()->user()->id;

        $tahapans = TahapanReview::where('mulai' , '<=', Carbon::now()->toDateString())
            ->where('selesai', '>=', Carbon::now()->toDateString())
            ->pluck('nama', 'id');

        $skemas = DB::table('reviews')
            ->leftJoin('pengabdians', 'reviews.usulan_id', '=', 'pengabdians.id')
            ->leftJoin('ref_skemas', 'ref_skemas.id', '=', 'pengabdians.skema_id')
            ->where('pengabdians.tahun', date('Y'))
            ->where('reviewer_id', $user_id)
            ->select(['ref_skemas.nama', 'ref_skemas.id'])
            ->get()
            ->pluck('nama', 'id');

        if($tahapans->count() > 0 && $skemas->count() > 0) {
            return view('reviews.pengabdians.index', compact('usulans', 'tahapans', 'skemas', 'user_id'));
        }

        return view('reviews.pengabdians.noreview');

    }

    public function filter(Request $request)
    {
        session()->put(['review_params' => [
            'tipe' => request('tipe'),
            'tahapan' => request('tahapan_review_id'),
            'skema' => request('skema_id')
        ]]);

        $usulans = $this->_filter(request('tahapan_review_id'), request('skema_id'));

        $user_id = auth()->user()->id;

        $tahapans = TahapanReview::where('mulai' , '<=', Carbon::now()->toDateString())
            ->where('selesai', '>=', Carbon::now()->toDateString())
            ->pluck('nama', 'id');

        $skemas = DB::table('reviews')
            ->leftJoin('pengabdians', 'reviews.usulan_id', '=', 'pengabdians.id')
            ->leftJoin('ref_skemas', 'ref_skemas.id', '=', 'pengabdians.skema_id')
            ->where('pengabdians.tahun', date('Y'))
            ->where('reviewer_id', $user_id)
            ->select(['ref_skemas.nama', 'ref_skemas.id'])
            ->get()
            ->pluck('nama', 'id');

        if($tahapans->count() > 0 && $skemas->count() > 0) {
            return view('reviews.pengabdians.index', compact('usulans', 'tahapans', 'skemas', 'user_id'));
        }

        return view('reviews.pengabdians.noreview');
    }

    public function edit($usulan_id)
    {

        abort_if(Gate::denies('review'), Response::HTTP_FORBIDDEN, 403);

        $review = Review::where('reviewer_id', auth()->user()->id)
            ->where('usulan_id', $usulan_id)
            ->first();

        abort_if(empty($review), Response::HTTP_FORBIDDEN, 403);

        $pengabdian = Pengabdian::findOrFail($usulan_id);
        $jawabans = ReviewPenilaian::where('review_id', $review->id)
            ->get()
            ->pluck('nilai', 'ref_skema_question_id');

        $questions = RefSkemaQuestion::where('ref_skema_id', $pengabdian->skema_id)->get();
        return view('reviews.pengabdians.edit', compact('pengabdian', 'questions', 'jawabans', 'review'));

    }

    public function update(Request $request, $usulan_id)
    {
        abort_if(Gate::denies('review'), Response::HTTP_FORBIDDEN, 403);

        $request->validate([
            'komentar' => 'required',
            'biaya' => 'required'
        ]);

        $review = Review::where('reviewer_id', auth()->user()->id)
            ->where('usulan_id', $usulan_id)
            ->first();

        if ($review == null)
            abort(404);

        $review->komentar = request('komentar');
        $review->biaya = request('biaya');
        $review->finished = 1;
        $review->save();

        if ($request->has('pertanyaans')) {
            $pertanyaans = $request->get('pertanyaans');
            foreach ($pertanyaans as $key => $value) {
                $penilaian = ReviewPenilaian::where('review_id', $review->id)
                    ->where('ref_skema_question_id', $key)
                    ->first();
                if (!$penilaian) {
                    $penilaian = new ReviewPenilaian();
                    $penilaian->review_id = $review->id;
                    $penilaian->ref_skema_question_id = $key;
                }
                $question = RefSkemaQuestion::findOrFail($key);
                $penilaian->bobot = $question->bobot;
                $penilaian->pertanyaan = $question->pertanyaan;
                $penilaian->nilai = $value;
                $penilaian->save();

            }
        }
        return redirect()->route('review-pengabdians.index');
    }

    public function _filter($tahapan, $skema)
    {
        $user_id = auth()->user()->id;

        $usulans = Pengabdian::where('skema_id', $skema)
            ->with('reviewers', 'reviewers.penilaians')
            ->whereHas('reviewers', function ($query) use ($user_id, $tahapan) {
                $query->where('reviewer_id', $user_id)
                    ->where('tahapan_review_id', $tahapan);
            })
            ->get();

        return $usulans;
    }
}
