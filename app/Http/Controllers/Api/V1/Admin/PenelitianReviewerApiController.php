<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePenelitianReviewerRequest;
use App\Http\Requests\UpdatePenelitianReviewerRequest;
use App\Http\Resources\Admin\PenelitianReviewerResource;
use App\PenelitianReviewer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PenelitianReviewerApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('penelitian_reviewer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PenelitianReviewerResource(PenelitianReviewer::with(['tahapan_review', 'reviewer', 'penelitian'])->get());
    }

    public function store(StorePenelitianReviewerRequest $request)
    {
        $penelitianReviewer = PenelitianReviewer::create($request->all());

        return (new PenelitianReviewerResource($penelitianReviewer))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PenelitianReviewer $penelitianReviewer)
    {
        abort_if(Gate::denies('penelitian_reviewer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PenelitianReviewerResource($penelitianReviewer->load(['tahapan_review', 'reviewer', 'penelitian']));
    }

    public function update(UpdatePenelitianReviewerRequest $request, PenelitianReviewer $penelitianReviewer)
    {
        $penelitianReviewer->update($request->all());

        return (new PenelitianReviewerResource($penelitianReviewer))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PenelitianReviewer $penelitianReviewer)
    {
        abort_if(Gate::denies('penelitian_reviewer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $penelitianReviewer->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
