<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPenelitianOutputRequest;
use App\Http\Requests\StorePenelitianOutputRequest;
use App\Http\Requests\UpdatePenelitianOutputRequest;
use App\OutputSkema;
use App\Penelitian;
use App\PenelitianOutput;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PenelitianOutputController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('penelitian_output_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $penelitianOutputs = PenelitianOutput::all();

        return view('admin.penelitianOutputs.index', compact('penelitianOutputs'));
    }

    public function create()
    {
        abort_if(Gate::denies('penelitian_output_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $output_skemas = OutputSkema::all()->pluck('field', 'id')->prepend(trans('global.pleaseSelect'), '');

        $penelitians = Penelitian::all()->pluck('judul', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.penelitianOutputs.create', compact('output_skemas', 'penelitians'));
    }

    public function store(StorePenelitianOutputRequest $request)
    {
        $penelitianOutput = PenelitianOutput::create($request->all());

        return redirect()->route('admin.penelitian-outputs.index');
    }

    public function edit(PenelitianOutput $penelitianOutput)
    {
        abort_if(Gate::denies('penelitian_output_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $output_skemas = OutputSkema::all()->pluck('field', 'id')->prepend(trans('global.pleaseSelect'), '');

        $penelitians = Penelitian::all()->pluck('judul', 'id')->prepend(trans('global.pleaseSelect'), '');

        $penelitianOutput->load('output_skema', 'penelitian');

        return view('admin.penelitianOutputs.edit', compact('output_skemas', 'penelitians', 'penelitianOutput'));
    }

    public function update(UpdatePenelitianOutputRequest $request, PenelitianOutput $penelitianOutput)
    {
        $penelitianOutput->update($request->all());

        return redirect()->route('admin.penelitian-outputs.index');
    }

    public function show(PenelitianOutput $penelitianOutput)
    {
        abort_if(Gate::denies('penelitian_output_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $penelitianOutput->load('output_skema', 'penelitian');

        return view('admin.penelitianOutputs.show', compact('penelitianOutput'));
    }

    public function destroy(PenelitianOutput $penelitianOutput)
    {
        abort_if(Gate::denies('penelitian_output_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $penelitianOutput->delete();

        return back();
    }

    public function massDestroy(MassDestroyPenelitianOutputRequest $request)
    {
        PenelitianOutput::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
