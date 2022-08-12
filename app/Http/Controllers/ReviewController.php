<?php

namespace App\Http\Controllers;

use App\Penelitian;
use App\Pengabdian;
use App\RefSkema;
use App\RefSkemaQuestion;
use App\Review;
use App\ReviewPenilaian;
use App\TahapanReview;
use App\Usulan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Gate;

class ReviewController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('review'), Response::HTTP_FORBIDDEN, 403);

        $usulans = collect([]);

        if (session()->has('review_params')) {
            $params = session()->get('review_params');
            //dd($params);
            $usulans = $this->_filter($params['tipe'], $params['tahapan'], $params['skema']);
        }


        $tipes = Usulan::JENIS_USULAN;
        $tahapans = TahapanReview::all()->pluck('nama', 'id');
        $skemas = RefSkema::where('jenis_usulan', Usulan::PENELITIAN)
            ->get()
            ->pluck('nama', 'id');

        $user_id = auth()->user()->id;

        return view('reviews.index', compact('usulans', 'tipes', 'tahapans', 'skemas', 'user_id'));
    }

    public function filter(Request $request)
    {
        session()->put(['review_params' => [
            'tipe' => request('tipe'),
            'tahapan' => request('tahapan_review_id'),
            'skema' => request('skema_id')
        ]]);

        $usulans = $this->_filter(request('tipe'), request('tahapan_review_id'), request('skema_id'));

        $tipes = Usulan::JENIS_USULAN;
        $tahapans = TahapanReview::all()->pluck('nama', 'id');
        $skemas = RefSkema::where('jenis_usulan', Usulan::PENELITIAN)
            ->get()
            ->pluck('nama', 'id');

        $user_id = auth()->user()->id;

        return view('reviews.index', compact('usulans', 'tipes', 'tahapans', 'skemas', 'user_id'));
    }

    public function edit($usulan_id)
    {

        abort_if(Gate::denies('review'), Response::HTTP_FORBIDDEN, 403);

        $review = Review::where('reviewer_id', auth()->user()->id)
            ->where('usulan_id', $usulan_id)
            ->first();

        abort_if(empty($review), Response::HTTP_FORBIDDEN, 403);

        $usulan = Usulan::findOrFail($usulan_id);

        if ($usulan->jenis_usulan == Usulan::PENELITIAN) {
            $penelitian = Penelitian::findOrFail($usulan_id);
            $jawabans = ReviewPenilaian::where('review_id', $review->id)
                ->get()
                ->pluck('nilai', 'ref_skema_question_id');

            $questions = RefSkemaQuestion::where('ref_skema_id', $penelitian->skema_id)->get();
//            dd($jawabans, $questions);
            return view('reviews.edit_penelitian', compact('penelitian', 'questions', 'jawabans', 'review'));
        } elseif ($usulan->jenis_usulan == Usulan::PENGABDIAN) {
            $pengabdian = Pengabdian::findOrFail($usulan_id);
            return view('reviews.edit_pengabdian', compact('pengabdian', 'questions', 'jawabans', 'review'));
        }
    }

    public function update(Request $request, $usulan_id)
    {
        abort_if(Gate::denies('review'), Response::HTTP_FORBIDDEN, 403);

        $review = Review::where('reviewer_id', auth()->user()->id)
            ->where('usulan_id', $usulan_id)
            ->first();

        if ($review == null)
            abort(404);

        $review->komentar = request('komentar');
        $review->biaya = request('biaya');
        $review->save();

        if ($request->has('pertanyaans')) {
            $pertanyaans = $request->get('pertanyaans');
            foreach($pertanyaans as $key => $value){
                $penilaian = ReviewPenilaian::where('review_id', $review->id)
                    ->where('ref_skema_question_id', $key)
                    ->first();
                if(!$penilaian){
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
        return redirect()->route('reviews.index');
    }

    public function _filter($tipe, $tahapan, $skema)
    {
        $user_id = auth()->user()->id;

        if ($tipe == Usulan::PENELITIAN) {
            $usulans = Penelitian::where('skema_id', $skema)
                ->with('reviewers', 'reviewers.penilaians')
                ->whereHas('reviewers', function ($query) use ($user_id, $tahapan) {
                    $query->where('reviewer_id', $user_id)
                        ->where('tahapan_review_id', $tahapan);
                })
                ->get();

        } elseif ($tipe == Usulan::PENGABDIAN) {
            $usulans = Pengabdian::where('tipe', $tipe)
                ->whereHas('reviewers', function ($query) use ($user_id, $tahapan) {
                    $query->where('reviewer_id', $user_id)
                        ->where('tahapan_review_id', $tahapan);
                })
                ->get();
        }

        return $usulans;

    }
}
