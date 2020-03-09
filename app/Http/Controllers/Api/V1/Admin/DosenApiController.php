<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Dosen;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDosenRequest;
use App\Http\Requests\UpdateDosenRequest;
use App\Http\Resources\Admin\DosenResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DosenApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('dosen_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DosenResource(Dosen::with(['prodi'])->get());
    }

    public function store(StoreDosenRequest $request)
    {
        $dosen = Dosen::create($request->all());

        return (new DosenResource($dosen))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Dosen $dosen)
    {
        abort_if(Gate::denies('dosen_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DosenResource($dosen->load(['prodi']));
    }

    public function update(UpdateDosenRequest $request, Dosen $dosen)
    {
        $dosen->update($request->all());

        return (new DosenResource($dosen))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Dosen $dosen)
    {
        abort_if(Gate::denies('dosen_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dosen->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
