<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRipSubTemaRequest;
use App\Http\Requests\UpdateRipSubTemaRequest;
use App\Http\Resources\Admin\RipSubTemaResource;
use App\RipSubTema;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RipSubTemaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('rip_sub_tema_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RipSubTemaResource(RipSubTema::with(['tema'])->get());
    }

    public function store(StoreRipSubTemaRequest $request)
    {
        $ripSubTema = RipSubTema::create($request->all());

        return (new RipSubTemaResource($ripSubTema))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(RipSubTema $ripSubTema)
    {
        abort_if(Gate::denies('rip_sub_tema_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RipSubTemaResource($ripSubTema->load(['tema']));
    }

    public function update(UpdateRipSubTemaRequest $request, RipSubTema $ripSubTema)
    {
        $ripSubTema->update($request->all());

        return (new RipSubTemaResource($ripSubTema))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(RipSubTema $ripSubTema)
    {
        abort_if(Gate::denies('rip_sub_tema_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ripSubTema->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
