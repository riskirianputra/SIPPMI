<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPenelitianReviewerRequest;
use App\Http\Requests\StorePenelitianReviewerRequest;
use App\Http\Requests\UpdatePenelitianReviewerRequest;
use App\Penelitian;
use App\PenelitianReviewer;
use App\Reviewer;
use App\TahapanReview;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PenelitianReviewerController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('penelitian_reviewer_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $penelitianReviewers = PenelitianReviewer::all();

        return view('admin.penelitianReviewers.index', compact('penelitianReviewers'));
    }

    public function create()
    {
        abort_if(Gate::denies('penelitian_reviewer_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tahapan_reviews = TahapanReview::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $reviewers = Reviewer::all()->pluck('status', 'id')->prepend(trans('global.pleaseSelect'), '');

        $penelitians = Penelitian::all()->pluck('judul', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.penelitianReviewers.create', compact('tahapan_reviews', 'reviewers', 'penelitians'));
    }

    public function store(StorePenelitianReviewerRequest $request)
    {
        $penelitianReviewer = PenelitianReviewer::create($request->all());

        return redirect()->route('admin.penelitian-reviewers.index');
    }

    public function edit(PenelitianReviewer $penelitianReviewer)
    {
        abort_if(Gate::denies('penelitian_reviewer_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tahapan_reviews = TahapanReview::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $reviewers = Reviewer::all()->pluck('status', 'id')->prepend(trans('global.pleaseSelect'), '');

        $penelitians = Penelitian::all()->pluck('judul', 'id')->prepend(trans('global.pleaseSelect'), '');

        $penelitianReviewer->load('tahapan_review', 'reviewer', 'penelitian');

        return view('admin.penelitianReviewers.edit', compact('tahapan_reviews', 'reviewers', 'penelitians', 'penelitianReviewer'));
    }

    public function update(UpdatePenelitianReviewerRequest $request, PenelitianReviewer $penelitianReviewer)
    {
        $penelitianReviewer->update($request->all());

        return redirect()->route('admin.penelitian-reviewers.index');
    }

    public function show(PenelitianReviewer $penelitianReviewer)
    {
        abort_if(Gate::denies('penelitian_reviewer_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $penelitianReviewer->load('tahapan_review', 'reviewer', 'penelitian');

        return view('admin.penelitianReviewers.show', compact('penelitianReviewer'));
    }

    public function destroy(PenelitianReviewer $penelitianReviewer)
    {
        abort_if(Gate::denies('penelitian_reviewer_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $penelitianReviewer->delete();

        return back();
    }

    public function massDestroy(MassDestroyPenelitianReviewerRequest $request)
    {
        PenelitianReviewer::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
