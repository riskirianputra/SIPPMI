<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProdiRequest;
use App\Http\Requests\UpdateProdiRequest;
use App\Http\Resources\Admin\ProdiResource;
use App\Prodi;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProdiApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('prodi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProdiResource(Prodi::with(['fakultas'])->get());
    }

    public function store(StoreProdiRequest $request)
    {
        $prodi = Prodi::create($request->all());

        return (new ProdiResource($prodi))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Prodi $prodi)
    {
        abort_if(Gate::denies('prodi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProdiResource($prodi->load(['fakultas']));
    }

    public function update(UpdateProdiRequest $request, Prodi $prodi)
    {
        $prodi->update($request->all());

        return (new ProdiResource($prodi))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Prodi $prodi)
    {
        abort_if(Gate::denies('prodi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prodi->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
