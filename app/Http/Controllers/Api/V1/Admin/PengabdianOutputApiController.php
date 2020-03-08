<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePengabdianOutputRequest;
use App\Http\Requests\UpdatePengabdianOutputRequest;
use App\Http\Resources\Admin\PengabdianOutputResource;
use App\PengabdianOutput;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PengabdianOutputApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pengabdian_output_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PengabdianOutputResource(PengabdianOutput::with(['output_skema', 'pengabdian'])->get());
    }

    public function store(StorePengabdianOutputRequest $request)
    {
        $pengabdianOutput = PengabdianOutput::create($request->all());

        return (new PengabdianOutputResource($pengabdianOutput))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PengabdianOutput $pengabdianOutput)
    {
        abort_if(Gate::denies('pengabdian_output_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PengabdianOutputResource($pengabdianOutput->load(['output_skema', 'pengabdian']));
    }

    public function update(UpdatePengabdianOutputRequest $request, PengabdianOutput $pengabdianOutput)
    {
        $pengabdianOutput->update($request->all());

        return (new PengabdianOutputResource($pengabdianOutput))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PengabdianOutput $pengabdianOutput)
    {
        abort_if(Gate::denies('pengabdian_output_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pengabdianOutput->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
