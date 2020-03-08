<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePengabdianBiayaRequest;
use App\Http\Requests\UpdatePengabdianBiayaRequest;
use App\Http\Resources\Admin\PengabdianBiayaResource;
use App\PengabdianBiaya;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PengabdianBiayaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pengabdian_biaya_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PengabdianBiayaResource(PengabdianBiaya::with(['biaya_skema', 'pengabdian'])->get());
    }

    public function store(StorePengabdianBiayaRequest $request)
    {
        $pengabdianBiaya = PengabdianBiaya::create($request->all());

        return (new PengabdianBiayaResource($pengabdianBiaya))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PengabdianBiaya $pengabdianBiaya)
    {
        abort_if(Gate::denies('pengabdian_biaya_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PengabdianBiayaResource($pengabdianBiaya->load(['biaya_skema', 'pengabdian']));
    }

    public function update(UpdatePengabdianBiayaRequest $request, PengabdianBiaya $pengabdianBiaya)
    {
        $pengabdianBiaya->update($request->all());

        return (new PengabdianBiayaResource($pengabdianBiaya))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PengabdianBiaya $pengabdianBiaya)
    {
        abort_if(Gate::denies('pengabdian_biaya_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pengabdianBiaya->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
