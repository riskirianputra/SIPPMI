<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRipTopikRequest;
use App\Http\Requests\UpdateRipTopikRequest;
use App\Http\Resources\Admin\RipTopikResource;
use App\RipTopik;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RipTopikApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('rip_topik_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RipTopikResource(RipTopik::with(['subtema'])->get());
    }

    public function store(StoreRipTopikRequest $request)
    {
        $ripTopik = RipTopik::create($request->all());

        return (new RipTopikResource($ripTopik))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(RipTopik $ripTopik)
    {
        abort_if(Gate::denies('rip_topik_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RipTopikResource($ripTopik->load(['subtema']));
    }

    public function update(UpdateRipTopikRequest $request, RipTopik $ripTopik)
    {
        $ripTopik->update($request->all());

        return (new RipTopikResource($ripTopik))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(RipTopik $ripTopik)
    {
        abort_if(Gate::denies('rip_topik_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ripTopik->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
