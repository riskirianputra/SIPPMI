<?php

namespace App\Http\Controllers\Admin;

use App\BiayaSkema;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPengabdianBiayaRequest;
use App\Http\Requests\StorePengabdianBiayaRequest;
use App\Http\Requests\UpdatePengabdianBiayaRequest;
use App\Pengabdian;
use App\PengabdianBiaya;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PengabdianBiayaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pengabdian_biaya_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pengabdianBiayas = PengabdianBiaya::all();

        return view('admin.pengabdianBiayas.index', compact('pengabdianBiayas'));
    }

    public function create()
    {
        abort_if(Gate::denies('pengabdian_biaya_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $biaya_skemas = BiayaSkema::all()->pluck('persen_max', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pengabdians = Pengabdian::all()->pluck('judul', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.pengabdianBiayas.create', compact('biaya_skemas', 'pengabdians'));
    }

    public function store(StorePengabdianBiayaRequest $request)
    {
        $pengabdianBiaya = PengabdianBiaya::create($request->all());

        return redirect()->route('admin.pengabdian-biayas.index');
    }

    public function edit(PengabdianBiaya $pengabdianBiaya)
    {
        abort_if(Gate::denies('pengabdian_biaya_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $biaya_skemas = BiayaSkema::all()->pluck('persen_max', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pengabdians = Pengabdian::all()->pluck('judul', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pengabdianBiaya->load('biaya_skema', 'pengabdian');

        return view('admin.pengabdianBiayas.edit', compact('biaya_skemas', 'pengabdians', 'pengabdianBiaya'));
    }

    public function update(UpdatePengabdianBiayaRequest $request, PengabdianBiaya $pengabdianBiaya)
    {
        $pengabdianBiaya->update($request->all());

        return redirect()->route('admin.pengabdian-biayas.index');
    }

    public function show(PengabdianBiaya $pengabdianBiaya)
    {
        abort_if(Gate::denies('pengabdian_biaya_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pengabdianBiaya->load('biaya_skema', 'pengabdian');

        return view('admin.pengabdianBiayas.show', compact('pengabdianBiaya'));
    }

    public function destroy(PengabdianBiaya $pengabdianBiaya)
    {
        abort_if(Gate::denies('pengabdian_biaya_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pengabdianBiaya->delete();

        return back();
    }

    public function massDestroy(MassDestroyPengabdianBiayaRequest $request)
    {
        PengabdianBiaya::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
