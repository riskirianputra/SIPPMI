<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKodeRumpunRequest;
use App\Http\Requests\UpdateKodeRumpunRequest;
use App\Http\Resources\Admin\KodeRumpunResource;
use App\KodeRumpun;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KodeRumpunApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('kode_rumpun_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KodeRumpunResource(KodeRumpun::all());
    }

    public function store(StoreKodeRumpunRequest $request)
    {
        $kodeRumpun = KodeRumpun::create($request->all());

        return (new KodeRumpunResource($kodeRumpun))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(KodeRumpun $kodeRumpun)
    {
        abort_if(Gate::denies('kode_rumpun_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KodeRumpunResource($kodeRumpun);
    }

    public function update(UpdateKodeRumpunRequest $request, KodeRumpun $kodeRumpun)
    {
        $kodeRumpun->update($request->all());

        return (new KodeRumpunResource($kodeRumpun))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(KodeRumpun $kodeRumpun)
    {
        abort_if(Gate::denies('kode_rumpun_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kodeRumpun->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
