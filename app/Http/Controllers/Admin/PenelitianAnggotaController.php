<?php

namespace App\Http\Controllers\Admin;

use App\Dosen;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPenelitianAnggotumRequest;
use App\Http\Requests\StorePenelitianAnggotumRequest;
use App\Http\Requests\UpdatePenelitianAnggotumRequest;
use App\Penelitian;
use App\PenelitianAnggotum;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PenelitianAnggotaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('penelitian_anggotum_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $penelitianAnggota = PenelitianAnggotum::all();

        return view('admin.penelitianAnggota.index', compact('penelitianAnggota'));
    }

    public function create()
    {
        abort_if(Gate::denies('penelitian_anggotum_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dosens = Dosen::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $penelitians = Penelitian::all()->pluck('judul', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.penelitianAnggota.create', compact('dosens', 'penelitians'));
    }

    public function store(StorePenelitianAnggotumRequest $request)
    {
        $penelitianAnggotum = PenelitianAnggotum::create($request->all());

        return redirect()->route('admin.penelitian-anggota.index');
    }

    public function edit(PenelitianAnggotum $penelitianAnggotum)
    {
        abort_if(Gate::denies('penelitian_anggotum_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dosens = Dosen::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $penelitians = Penelitian::all()->pluck('judul', 'id')->prepend(trans('global.pleaseSelect'), '');

        $penelitianAnggotum->load('dosen', 'penelitian');

        return view('admin.penelitianAnggota.edit', compact('dosens', 'penelitians', 'penelitianAnggotum'));
    }

    public function update(UpdatePenelitianAnggotumRequest $request, PenelitianAnggotum $penelitianAnggotum)
    {
        $penelitianAnggotum->update($request->all());

        return redirect()->route('admin.penelitian-anggota.index');
    }

    public function show(PenelitianAnggotum $penelitianAnggotum)
    {
        abort_if(Gate::denies('penelitian_anggotum_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $penelitianAnggotum->load('dosen', 'penelitian');

        return view('admin.penelitianAnggota.show', compact('penelitianAnggotum'));
    }

    public function destroy(PenelitianAnggotum $penelitianAnggotum)
    {
        abort_if(Gate::denies('penelitian_anggotum_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $penelitianAnggotum->delete();

        return back();
    }

    public function massDestroy(MassDestroyPenelitianAnggotumRequest $request)
    {
        PenelitianAnggotum::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
