<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRipSubTopikRequest;
use App\Http\Requests\UpdateRipSubTopikRequest;
use App\Http\Resources\Admin\RipSubTopikResource;
use App\RipSubTopik;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RipSubTopikApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('rip_sub_topik_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RipSubTopikResource(RipSubTopik::with(['topik'])->get());
    }

    public function store(StoreRipSubTopikRequest $request)
    {
        $ripSubTopik = RipSubTopik::create($request->all());

        return (new RipSubTopikResource($ripSubTopik))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(RipSubTopik $ripSubTopik)
    {
        abort_if(Gate::denies('rip_sub_topik_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RipSubTopikResource($ripSubTopik->load(['topik']));
    }

    public function update(UpdateRipSubTopikRequest $request, RipSubTopik $ripSubTopik)
    {
        $ripSubTopik->update($request->all());

        return (new RipSubTopikResource($ripSubTopik))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(RipSubTopik $ripSubTopik)
    {
        abort_if(Gate::denies('rip_sub_topik_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ripSubTopik->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
