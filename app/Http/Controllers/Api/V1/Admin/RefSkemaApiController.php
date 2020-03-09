<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRefSkemaRequest;
use App\Http\Requests\UpdateRefSkemaRequest;
use App\Http\Resources\Admin\RefSkemaResource;
use App\RefSkema;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RefSkemaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ref_skema_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RefSkemaResource(RefSkema::with(['jenis_usulan'])->get());
    }

    public function store(StoreRefSkemaRequest $request)
    {
        $refSkema = RefSkema::create($request->all());

        return (new RefSkemaResource($refSkema))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(RefSkema $refSkema)
    {
        abort_if(Gate::denies('ref_skema_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RefSkemaResource($refSkema->load(['jenis_usulan']));
    }

    public function update(UpdateRefSkemaRequest $request, RefSkema $refSkema)
    {
        $refSkema->update($request->all());

        return (new RefSkemaResource($refSkema))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(RefSkema $refSkema)
    {
        abort_if(Gate::denies('ref_skema_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $refSkema->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
