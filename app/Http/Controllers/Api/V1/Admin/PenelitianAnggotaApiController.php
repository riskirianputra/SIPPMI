<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePenelitianAnggotumRequest;
use App\Http\Requests\UpdatePenelitianAnggotumRequest;
use App\Http\Resources\Admin\PenelitianAnggotumResource;
use App\PenelitianAnggotum;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PenelitianAnggotaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('penelitian_anggotum_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PenelitianAnggotumResource(PenelitianAnggotum::with(['dosen', 'penelitian'])->get());
    }

    public function store(StorePenelitianAnggotumRequest $request)
    {
        $penelitianAnggotum = PenelitianAnggotum::create($request->all());

        return (new PenelitianAnggotumResource($penelitianAnggotum))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PenelitianAnggotum $penelitianAnggotum)
    {
        abort_if(Gate::denies('penelitian_anggotum_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PenelitianAnggotumResource($penelitianAnggotum->load(['dosen', 'penelitian']));
    }

    public function update(UpdatePenelitianAnggotumRequest $request, PenelitianAnggotum $penelitianAnggotum)
    {
        $penelitianAnggotum->update($request->all());

        return (new PenelitianAnggotumResource($penelitianAnggotum))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PenelitianAnggotum $penelitianAnggotum)
    {
        abort_if(Gate::denies('penelitian_anggotum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $penelitianAnggotum->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
