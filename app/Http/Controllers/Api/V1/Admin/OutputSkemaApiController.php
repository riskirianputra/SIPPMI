<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOutputSkemaRequest;
use App\Http\Requests\UpdateOutputSkemaRequest;
use App\Http\Resources\Admin\OutputSkemaResource;
use App\OutputSkema;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OutputSkemaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('output_skema_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OutputSkemaResource(OutputSkema::with(['output', 'skema'])->get());
    }

    public function store(StoreOutputSkemaRequest $request)
    {
        $outputSkema = OutputSkema::create($request->all());

        return (new OutputSkemaResource($outputSkema))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(OutputSkema $outputSkema)
    {
        abort_if(Gate::denies('output_skema_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OutputSkemaResource($outputSkema->load(['output', 'skema']));
    }

    public function update(UpdateOutputSkemaRequest $request, OutputSkema $outputSkema)
    {
        $outputSkema->update($request->all());

        return (new OutputSkemaResource($outputSkema))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(OutputSkema $outputSkema)
    {
        abort_if(Gate::denies('output_skema_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $outputSkema->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
