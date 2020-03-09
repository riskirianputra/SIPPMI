<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePengabdianAnggotumRequest;
use App\Http\Requests\UpdatePengabdianAnggotumRequest;
use App\Http\Resources\Admin\PengabdianAnggotumResource;
use App\PengabdianAnggotum;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PengabdianAnggotaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pengabdian_anggotum_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PengabdianAnggotumResource(PengabdianAnggotum::with(['pengabdian', 'dosen'])->get());
    }

    public function store(StorePengabdianAnggotumRequest $request)
    {
        $pengabdianAnggotum = PengabdianAnggotum::create($request->all());

        return (new PengabdianAnggotumResource($pengabdianAnggotum))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PengabdianAnggotum $pengabdianAnggotum)
    {
        abort_if(Gate::denies('pengabdian_anggotum_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PengabdianAnggotumResource($pengabdianAnggotum->load(['pengabdian', 'dosen']));
    }

    public function update(UpdatePengabdianAnggotumRequest $request, PengabdianAnggotum $pengabdianAnggotum)
    {
        $pengabdianAnggotum->update($request->all());

        return (new PengabdianAnggotumResource($pengabdianAnggotum))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PengabdianAnggotum $pengabdianAnggotum)
    {
        abort_if(Gate::denies('pengabdian_anggotum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pengabdianAnggotum->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
