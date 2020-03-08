<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRipSubTopikRequest;
use App\Http\Requests\StoreRipSubTopikRequest;
use App\Http\Requests\UpdateRipSubTopikRequest;
use App\RipSubTopik;
use App\RipTopik;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RipSubTopikController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('rip_sub_topik_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ripSubTopiks = RipSubTopik::all();

        return view('admin.ripSubTopiks.index', compact('ripSubTopiks'));
    }

    public function create()
    {
        abort_if(Gate::denies('rip_sub_topik_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $topiks = RipTopik::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.ripSubTopiks.create', compact('topiks'));
    }

    public function store(StoreRipSubTopikRequest $request)
    {
        $ripSubTopik = RipSubTopik::create($request->all());

        return redirect()->route('admin.rip-sub-topiks.index');
    }

    public function edit(RipSubTopik $ripSubTopik)
    {
        abort_if(Gate::denies('rip_sub_topik_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $topiks = RipTopik::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ripSubTopik->load('topik');

        return view('admin.ripSubTopiks.edit', compact('topiks', 'ripSubTopik'));
    }

    public function update(UpdateRipSubTopikRequest $request, RipSubTopik $ripSubTopik)
    {
        $ripSubTopik->update($request->all());

        return redirect()->route('admin.rip-sub-topiks.index');
    }

    public function show(RipSubTopik $ripSubTopik)
    {
        abort_if(Gate::denies('rip_sub_topik_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ripSubTopik->load('topik', 'subTopikRipTahapans');

        return view('admin.ripSubTopiks.show', compact('ripSubTopik'));
    }

    public function destroy(RipSubTopik $ripSubTopik)
    {
        abort_if(Gate::denies('rip_sub_topik_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ripSubTopik->delete();

        return back();
    }

    public function massDestroy(MassDestroyRipSubTopikRequest $request)
    {
        RipSubTopik::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
