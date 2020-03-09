<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRipTemaRequest;
use App\Http\Requests\StoreRipTemaRequest;
use App\Http\Requests\UpdateRipTemaRequest;
use App\RipTema;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RipTemaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('rip_tema_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ripTemas = RipTema::all();

        return view('admin.ripTemas.index', compact('ripTemas'));
    }

    public function create()
    {
        abort_if(Gate::denies('rip_tema_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ripTemas.create');
    }

    public function store(StoreRipTemaRequest $request)
    {
        $ripTema = RipTema::create($request->all());

        return redirect()->route('admin.rip-temas.index');
    }

    public function edit(RipTema $ripTema)
    {
        abort_if(Gate::denies('rip_tema_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ripTemas.edit', compact('ripTema'));
    }

    public function update(UpdateRipTemaRequest $request, RipTema $ripTema)
    {
        $ripTema->update($request->all());

        return redirect()->route('admin.rip-temas.index');
    }

    public function show(RipTema $ripTema)
    {
        abort_if(Gate::denies('rip_tema_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ripTema->load('temaRipSubTemas');

        return view('admin.ripTemas.show', compact('ripTema'));
    }

    public function destroy(RipTema $ripTema)
    {
        abort_if(Gate::denies('rip_tema_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ripTema->delete();

        return back();
    }

    public function massDestroy(MassDestroyRipTemaRequest $request)
    {
        RipTema::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
