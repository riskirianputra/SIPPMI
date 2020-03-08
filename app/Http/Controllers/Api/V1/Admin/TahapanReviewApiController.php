<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTahapanReviewRequest;
use App\Http\Requests\UpdateTahapanReviewRequest;
use App\Http\Resources\Admin\TahapanReviewResource;
use App\TahapanReview;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TahapanReviewApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tahapan_review_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TahapanReviewResource(TahapanReview::all());
    }

    public function store(StoreTahapanReviewRequest $request)
    {
        $tahapanReview = TahapanReview::create($request->all());

        return (new TahapanReviewResource($tahapanReview))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TahapanReview $tahapanReview)
    {
        abort_if(Gate::denies('tahapan_review_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TahapanReviewResource($tahapanReview);
    }

    public function update(UpdateTahapanReviewRequest $request, TahapanReview $tahapanReview)
    {
        $tahapanReview->update($request->all());

        return (new TahapanReviewResource($tahapanReview))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TahapanReview $tahapanReview)
    {
        abort_if(Gate::denies('tahapan_review_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tahapanReview->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
