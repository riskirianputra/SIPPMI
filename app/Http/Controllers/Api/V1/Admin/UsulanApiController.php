<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUsulanRequest;
use App\Http\Requests\UpdateUsulanRequest;
use App\Http\Resources\Admin\UsulanResource;
use App\Usulan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsulanApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('usulan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UsulanResource(Usulan::with(['pengusul'])->get());
    }

    public function store(StoreUsulanRequest $request)
    {
        $usulan = Usulan::create($request->all());

        return (new UsulanResource($usulan))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Usulan $usulan)
    {
        abort_if(Gate::denies('usulan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UsulanResource($usulan->load(['pengusul']));
    }

    public function update(UpdateUsulanRequest $request, Usulan $usulan)
    {
        $usulan->update($request->all());

        return (new UsulanResource($usulan))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Usulan $usulan)
    {
        abort_if(Gate::denies('usulan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usulan->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
