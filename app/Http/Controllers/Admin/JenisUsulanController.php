<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyJenisUsulanRequest;
use App\Http\Requests\StoreJenisUsulanRequest;
use App\Http\Requests\UpdateJenisUsulanRequest;
use App\JenisUsulan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JenisUsulanController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('jenis_usulan_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jenisUsulans = JenisUsulan::all();

        return view('admin.jenisUsulans.index', compact('jenisUsulans'));
    }

    public function create()
    {
        abort_if(Gate::denies('jenis_usulan_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.jenisUsulans.create');
    }

    public function store(StoreJenisUsulanRequest $request)
    {
        $jenisUsulan = JenisUsulan::create($request->all());

        return redirect()->route('admin.jenis-usulans.index');
    }

    public function edit(JenisUsulan $jenisUsulan)
    {
        abort_if(Gate::denies('jenis_usulan_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.jenisUsulans.edit', compact('jenisUsulan'));
    }

    public function update(UpdateJenisUsulanRequest $request, JenisUsulan $jenisUsulan)
    {
        $jenisUsulan->update($request->all());

        return redirect()->route('admin.jenis-usulans.index');
    }

    public function show(JenisUsulan $jenisUsulan)
    {
        abort_if(Gate::denies('jenis_usulan_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jenisUsulan->load('jenisUsulanRefSkemas', 'jenisUsulanOutputs');

        return view('admin.jenisUsulans.show', compact('jenisUsulan'));
    }

    public function destroy(JenisUsulan $jenisUsulan)
    {
        abort_if(Gate::denies('jenis_usulan_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jenisUsulan->delete();

        return back();
    }

    public function massDestroy(MassDestroyJenisUsulanRequest $request)
    {
        JenisUsulan::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
