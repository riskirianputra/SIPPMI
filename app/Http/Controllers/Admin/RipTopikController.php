<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRipTopikRequest;
use App\Http\Requests\StoreRipTopikRequest;
use App\Http\Requests\UpdateRipTopikRequest;
use App\RipSubTema;
use App\RipTopik;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RipTopikController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('rip_topik_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ripTopiks = RipTopik::all();

        return view('admin.ripTopiks.index', compact('ripTopiks'));
    }

    public function create()
    {
        abort_if(Gate::denies('rip_topik_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subtemas = RipSubTema::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.ripTopiks.create', compact('subtemas'));
    }

    public function store(StoreRipTopikRequest $request)
    {
        $ripTopik = RipTopik::create($request->all());

        return redirect()->route('admin.rip-topiks.index');
    }

    public function edit(RipTopik $ripTopik)
    {
        abort_if(Gate::denies('rip_topik_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subtemas = RipSubTema::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ripTopik->load('subtema');

        return view('admin.ripTopiks.edit', compact('subtemas', 'ripTopik'));
    }

    public function update(UpdateRipTopikRequest $request, RipTopik $ripTopik)
    {
        $ripTopik->update($request->all());

        return redirect()->route('admin.rip-topiks.index');
    }

    public function show(RipTopik $ripTopik)
    {
        abort_if(Gate::denies('rip_topik_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ripTopik->load('subtema', 'topikRipSubTopiks');

        return view('admin.ripTopiks.show', compact('ripTopik'));
    }

    public function destroy(RipTopik $ripTopik)
    {
        abort_if(Gate::denies('rip_topik_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ripTopik->delete();

        return back();
    }

    public function massDestroy(MassDestroyRipTopikRequest $request)
    {
        RipTopik::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
