<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRipTemaRequest;
use App\Http\Requests\UpdateRipTemaRequest;
use App\Http\Resources\Admin\RipTemaResource;
use App\RipTema;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RipTemaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('rip_tema_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RipTemaResource(RipTema::all());
    }

    public function store(StoreRipTemaRequest $request)
    {
        $ripTema = RipTema::create($request->all());

        return (new RipTemaResource($ripTema))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(RipTema $ripTema)
    {
        abort_if(Gate::denies('rip_tema_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RipTemaResource($ripTema);
    }

    public function update(UpdateRipTemaRequest $request, RipTema $ripTema)
    {
        $ripTema->update($request->all());

        return (new RipTemaResource($ripTema))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(RipTema $ripTema)
    {
        abort_if(Gate::denies('rip_tema_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ripTema->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
