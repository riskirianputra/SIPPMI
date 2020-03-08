<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreReviewerRequest;
use App\Http\Requests\UpdateReviewerRequest;
use App\Http\Resources\Admin\ReviewerResource;
use App\Reviewer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReviewerApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('reviewer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReviewerResource(Reviewer::all());
    }

    public function store(StoreReviewerRequest $request)
    {
        $reviewer = Reviewer::create($request->all());

        if ($request->input('sertifikat', false)) {
            $reviewer->addMedia(storage_path('tmp/uploads/' . $request->input('sertifikat')))->toMediaCollection('sertifikat');
        }

        return (new ReviewerResource($reviewer))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Reviewer $reviewer)
    {
        abort_if(Gate::denies('reviewer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReviewerResource($reviewer);
    }

    public function update(UpdateReviewerRequest $request, Reviewer $reviewer)
    {
        $reviewer->update($request->all());

        if ($request->input('sertifikat', false)) {
            if (!$reviewer->sertifikat || $request->input('sertifikat') !== $reviewer->sertifikat->file_name) {
                $reviewer->addMedia(storage_path('tmp/uploads/' . $request->input('sertifikat')))->toMediaCollection('sertifikat');
            }
        } elseif ($reviewer->sertifikat) {
            $reviewer->sertifikat->delete();
        }

        return (new ReviewerResource($reviewer))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Reviewer $reviewer)
    {
        abort_if(Gate::denies('reviewer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reviewer->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
