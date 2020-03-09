<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPengabdianOutputRequest;
use App\Http\Requests\StorePengabdianOutputRequest;
use App\Http\Requests\UpdatePengabdianOutputRequest;
use App\OutputSkema;
use App\Pengabdian;
use App\PengabdianOutput;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PengabdianOutputController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pengabdian_output_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pengabdianOutputs = PengabdianOutput::all();

        return view('admin.pengabdianOutputs.index', compact('pengabdianOutputs'));
    }

    public function create()
    {
        abort_if(Gate::denies('pengabdian_output_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $output_skemas = OutputSkema::all()->pluck('field', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pengabdians = Pengabdian::all()->pluck('judul', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.pengabdianOutputs.create', compact('output_skemas', 'pengabdians'));
    }

    public function store(StorePengabdianOutputRequest $request)
    {
        $pengabdianOutput = PengabdianOutput::create($request->all());

        return redirect()->route('admin.pengabdian-outputs.index');
    }

    public function edit(PengabdianOutput $pengabdianOutput)
    {
        abort_if(Gate::denies('pengabdian_output_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $output_skemas = OutputSkema::all()->pluck('field', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pengabdians = Pengabdian::all()->pluck('judul', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pengabdianOutput->load('output_skema', 'pengabdian');

        return view('admin.pengabdianOutputs.edit', compact('output_skemas', 'pengabdians', 'pengabdianOutput'));
    }

    public function update(UpdatePengabdianOutputRequest $request, PengabdianOutput $pengabdianOutput)
    {
        $pengabdianOutput->update($request->all());

        return redirect()->route('admin.pengabdian-outputs.index');
    }

    public function show(PengabdianOutput $pengabdianOutput)
    {
        abort_if(Gate::denies('pengabdian_output_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pengabdianOutput->load('output_skema', 'pengabdian');

        return view('admin.pengabdianOutputs.show', compact('pengabdianOutput'));
    }

    public function destroy(PengabdianOutput $pengabdianOutput)
    {
        abort_if(Gate::denies('pengabdian_output_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pengabdianOutput->delete();

        return back();
    }

    public function massDestroy(MassDestroyPengabdianOutputRequest $request)
    {
        PengabdianOutput::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
