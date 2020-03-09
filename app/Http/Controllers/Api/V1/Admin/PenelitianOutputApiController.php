<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePenelitianOutputRequest;
use App\Http\Requests\UpdatePenelitianOutputRequest;
use App\Http\Resources\Admin\PenelitianOutputResource;
use App\PenelitianOutput;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PenelitianOutputApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('penelitian_output_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PenelitianOutputResource(PenelitianOutput::with(['output_skema', 'penelitian'])->get());
    }

    public function store(StorePenelitianOutputRequest $request)
    {
        $penelitianOutput = PenelitianOutput::create($request->all());

        return (new PenelitianOutputResource($penelitianOutput))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PenelitianOutput $penelitianOutput)
    {
        abort_if(Gate::denies('penelitian_output_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PenelitianOutputResource($penelitianOutput->load(['output_skema', 'penelitian']));
    }

    public function update(UpdatePenelitianOutputRequest $request, PenelitianOutput $penelitianOutput)
    {
        $penelitianOutput->update($request->all());

        return (new PenelitianOutputResource($penelitianOutput))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PenelitianOutput $penelitianOutput)
    {
        abort_if(Gate::denies('penelitian_output_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $penelitianOutput->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
