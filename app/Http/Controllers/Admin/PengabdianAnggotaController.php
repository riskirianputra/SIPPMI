<?php

namespace App\Http\Controllers\Admin;

use App\Dosen;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPengabdianAnggotumRequest;
use App\Http\Requests\StorePengabdianAnggotumRequest;
use App\Http\Requests\UpdatePengabdianAnggotumRequest;
use App\Pengabdian;
use App\PengabdianAnggotum;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PengabdianAnggotaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pengabdian_anggotum_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pengabdianAnggota = PengabdianAnggotum::all();

        return view('admin.pengabdianAnggota.index', compact('pengabdianAnggota'));
    }

    public function create()
    {
        abort_if(Gate::denies('pengabdian_anggotum_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pengabdians = Pengabdian::all()->pluck('judul', 'id')->prepend(trans('global.pleaseSelect'), '');

        $dosens = Dosen::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.pengabdianAnggota.create', compact('pengabdians', 'dosens'));
    }

    public function store(StorePengabdianAnggotumRequest $request)
    {
        $pengabdianAnggotum = PengabdianAnggotum::create($request->all());

        return redirect()->route('admin.pengabdian-anggota.index');
    }

    public function edit(PengabdianAnggotum $pengabdianAnggotum)
    {
        abort_if(Gate::denies('pengabdian_anggotum_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pengabdians = Pengabdian::all()->pluck('judul', 'id')->prepend(trans('global.pleaseSelect'), '');

        $dosens = Dosen::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pengabdianAnggotum->load('pengabdian', 'dosen');

        return view('admin.pengabdianAnggota.edit', compact('pengabdians', 'dosens', 'pengabdianAnggotum'));
    }

    public function update(UpdatePengabdianAnggotumRequest $request, PengabdianAnggotum $pengabdianAnggotum)
    {
        $pengabdianAnggotum->update($request->all());

        return redirect()->route('admin.pengabdian-anggota.index');
    }

    public function show(PengabdianAnggotum $pengabdianAnggotum)
    {
        abort_if(Gate::denies('pengabdian_anggotum_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pengabdianAnggotum->load('pengabdian', 'dosen');

        return view('admin.pengabdianAnggota.show', compact('pengabdianAnggotum'));
    }

    public function destroy(PengabdianAnggotum $pengabdianAnggotum)
    {
        abort_if(Gate::denies('pengabdian_anggotum_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pengabdianAnggotum->delete();

        return back();
    }

    public function massDestroy(MassDestroyPengabdianAnggotumRequest $request)
    {
        PengabdianAnggotum::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
