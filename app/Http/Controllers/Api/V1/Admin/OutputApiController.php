<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOutputRequest;
use App\Http\Requests\UpdateOutputRequest;
use App\Http\Resources\Admin\OutputResource;
use App\Output;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OutputApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('output_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OutputResource(Output::with(['jenis_usulan'])->get());
    }

    public function store(StoreOutputRequest $request)
    {
        $output = Output::create($request->all());

        return (new OutputResource($output))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Output $output)
    {
        abort_if(Gate::denies('output_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OutputResource($output->load(['jenis_usulan']));
    }

    public function update(UpdateOutputRequest $request, Output $output)
    {
        $output->update($request->all());

        return (new OutputResource($output))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Output $output)
    {
        abort_if(Gate::denies('output_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $output->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
