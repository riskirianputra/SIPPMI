<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKomponenBiayaRequest;
use App\Http\Requests\UpdateKomponenBiayaRequest;
use App\Http\Resources\Admin\KomponenBiayaResource;
use App\KomponenBiaya;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KomponenBiayaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('komponen_biaya_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KomponenBiayaResource(KomponenBiaya::all());
    }

    public function store(StoreKomponenBiayaRequest $request)
    {
        $komponenBiaya = KomponenBiaya::create($request->all());

        return (new KomponenBiayaResource($komponenBiaya))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(KomponenBiaya $komponenBiaya)
    {
        abort_if(Gate::denies('komponen_biaya_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KomponenBiayaResource($komponenBiaya);
    }

    public function update(UpdateKomponenBiayaRequest $request, KomponenBiaya $komponenBiaya)
    {
        $komponenBiaya->update($request->all());

        return (new KomponenBiayaResource($komponenBiaya))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(KomponenBiaya $komponenBiaya)
    {
        abort_if(Gate::denies('komponen_biaya_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $komponenBiaya->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
