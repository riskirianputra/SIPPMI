<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRipSubTemaRequest;
use App\Http\Requests\StoreRipSubTemaRequest;
use App\Http\Requests\UpdateRipSubTemaRequest;
use App\RipSubTema;
use App\RipTema;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RipSubTemaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('rip_sub_tema_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ripSubTemas = RipSubTema::all();

        return view('admin.ripSubTemas.index', compact('ripSubTemas'));
    }

    public function create()
    {
        abort_if(Gate::denies('rip_sub_tema_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $temas = RipTema::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.ripSubTemas.create', compact('temas'));
    }

    public function store(StoreRipSubTemaRequest $request)
    {
        $ripSubTema = RipSubTema::create($request->all());

        return redirect()->route('admin.rip-sub-temas.index');
    }

    public function edit(RipSubTema $ripSubTema)
    {
        abort_if(Gate::denies('rip_sub_tema_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $temas = RipTema::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ripSubTema->load('tema');

        return view('admin.ripSubTemas.edit', compact('temas', 'ripSubTema'));
    }

    public function update(UpdateRipSubTemaRequest $request, RipSubTema $ripSubTema)
    {
        $ripSubTema->update($request->all());

        return redirect()->route('admin.rip-sub-temas.index');
    }

    public function show(RipSubTema $ripSubTema)
    {
        abort_if(Gate::denies('rip_sub_tema_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ripSubTema->load('tema', 'subtemaRipTopiks');

        return view('admin.ripSubTemas.show', compact('ripSubTema'));
    }

    public function destroy(RipSubTema $ripSubTema)
    {
        abort_if(Gate::denies('rip_sub_tema_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ripSubTema->delete();

        return back();
    }

    public function massDestroy(MassDestroyRipSubTemaRequest $request)
    {
        RipSubTema::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
