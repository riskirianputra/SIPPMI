<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRipTahapanRequest;
use App\Http\Requests\StoreRipTahapanRequest;
use App\Http\Requests\UpdateRipTahapanRequest;
use App\RipSubTopik;
use App\RipTahapan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RipTahapanController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('rip_tahapan_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ripTahapans = RipTahapan::all();

        return view('admin.ripTahapans.index', compact('ripTahapans'));
    }

    public function create()
    {
        abort_if(Gate::denies('rip_tahapan_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sub_topiks = RipSubTopik::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.ripTahapans.create', compact('sub_topiks'));
    }

    public function store(StoreRipTahapanRequest $request)
    {
        $ripTahapan = RipTahapan::create($request->all());

        return redirect()->route('admin.rip-tahapans.index');
    }

    public function edit(RipTahapan $ripTahapan)
    {
        abort_if(Gate::denies('rip_tahapan_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sub_topiks = RipSubTopik::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ripTahapan->load('sub_topik');

        return view('admin.ripTahapans.edit', compact('sub_topiks', 'ripTahapan'));
    }

    public function update(UpdateRipTahapanRequest $request, RipTahapan $ripTahapan)
    {
        $ripTahapan->update($request->all());

        return redirect()->route('admin.rip-tahapans.index');
    }

    public function show(RipTahapan $ripTahapan)
    {
        abort_if(Gate::denies('rip_tahapan_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ripTahapan->load('sub_topik', 'tahapanPenelitians');

        return view('admin.ripTahapans.show', compact('ripTahapan'));
    }

    public function destroy(RipTahapan $ripTahapan)
    {
        abort_if(Gate::denies('rip_tahapan_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ripTahapan->delete();

        return back();
    }

    public function massDestroy(MassDestroyRipTahapanRequest $request)
    {
        RipTahapan::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
