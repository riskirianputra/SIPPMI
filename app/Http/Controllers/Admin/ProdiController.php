<?php

namespace App\Http\Controllers\Admin;

use App\Fakultum;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProdiRequest;
use App\Http\Requests\StoreProdiRequest;
use App\Http\Requests\UpdateProdiRequest;
use App\Prodi;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProdiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('prodi_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prodis = Prodi::all();

        return view('admin.prodis.index', compact('prodis'));
    }

    public function create()
    {
        abort_if(Gate::denies('prodi_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fakultas = Fakultum::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.prodis.create', compact('fakultas'));
    }

    public function store(StoreProdiRequest $request)
    {
        $prodi = Prodi::create($request->all());

        return redirect()->route('admin.prodis.index');
    }

    public function edit(Prodi $prodi)
    {
        abort_if(Gate::denies('prodi_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fakultas = Fakultum::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $prodi->load('fakultas');

        return view('admin.prodis.edit', compact('fakultas', 'prodi'));
    }

    public function update(UpdateProdiRequest $request, Prodi $prodi)
    {
        $prodi->update($request->all());

        return redirect()->route('admin.prodis.index');
    }

    public function show(Prodi $prodi)
    {
        abort_if(Gate::denies('prodi_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prodi->load('fakultas', 'prodiPenelitians', 'prodiPengabdians', 'prodiDosens');

        return view('admin.prodis.show', compact('prodi'));
    }

    public function destroy(Prodi $prodi)
    {
        abort_if(Gate::denies('prodi_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prodi->delete();

        return back();
    }

    public function massDestroy(MassDestroyProdiRequest $request)
    {
        Prodi::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
