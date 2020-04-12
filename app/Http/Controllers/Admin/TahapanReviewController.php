<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTahapanReviewRequest;
use App\Http\Requests\StoreTahapanReviewRequest;
use App\Http\Requests\UpdateTahapanReviewRequest;
use App\TahapanReview;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TahapanReviewController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tahapan_review_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tahapanReviews = TahapanReview::all();

        return view('admins.reviews.tahapans.index', compact('tahapanReviews'));
    }

    public function create()
    {
        abort_if(Gate::denies('tahapan_review_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admins.reviews.tahapans.create');
    }

    public function store(StoreTahapanReviewRequest $request)
    {
        $tahapanReview = TahapanReview::create($request->all());

        return redirect()->route('admin.tahapan-reviews.index');
    }

    public function edit(TahapanReview $tahapanReview)
    {
        abort_if(Gate::denies('tahapan_review_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admins.reviews.tahapans.edit', compact('tahapanReview'));
    }

    public function update(UpdateTahapanReviewRequest $request, TahapanReview $tahapanReview)
    {
        $tahapanReview->update($request->all());

        return redirect()->route('admin.tahapan-reviews.index');
    }

    public function show(TahapanReview $tahapanReview)
    {
        abort_if(Gate::denies('tahapan_review_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tahapanReview->load('tahapanReviewPenelitianReviewers');

        return view('admins.reviews.tahapans.show', compact('tahapanReview'));
    }

    public function destroy(TahapanReview $tahapanReview)
    {
        abort_if(Gate::denies('tahapan_review_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tahapanReview->delete();

        return back();
    }

    public function massDestroy(MassDestroyTahapanReviewRequest $request)
    {
        TahapanReview::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
