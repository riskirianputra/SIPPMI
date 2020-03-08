<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRipTahapanRequest;
use App\Http\Requests\UpdateRipTahapanRequest;
use App\Http\Resources\Admin\RipTahapanResource;
use App\RipTahapan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RipTahapanApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('rip_tahapan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RipTahapanResource(RipTahapan::with(['sub_topik'])->get());
    }

    public function store(StoreRipTahapanRequest $request)
    {
        $ripTahapan = RipTahapan::create($request->all());

        return (new RipTahapanResource($ripTahapan))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(RipTahapan $ripTahapan)
    {
        abort_if(Gate::denies('rip_tahapan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RipTahapanResource($ripTahapan->load(['sub_topik']));
    }

    public function update(UpdateRipTahapanRequest $request, RipTahapan $ripTahapan)
    {
        $ripTahapan->update($request->all());

        return (new RipTahapanResource($ripTahapan))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(RipTahapan $ripTahapan)
    {
        abort_if(Gate::denies('rip_tahapan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ripTahapan->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
