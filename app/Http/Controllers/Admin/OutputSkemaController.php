<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOutputSkemaRequest;
use App\Http\Requests\StoreOutputSkemaRequest;
use App\Http\Requests\UpdateOutputSkemaRequest;
use App\Output;
use App\OutputSkema;
use App\RefSkema;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OutputSkemaController extends Controller
{
    public function index($refSkema_id)
    {
        abort_if(Gate::denies('output_skema_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $outputSkemas = OutputSkema::all();

        return view('admin.outputSkemas.index', compact('outputSkemas'));
    }

    public function create($refSkema_id)
    {
        abort_if(Gate::denies('output_skema_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $outputs = Output::all()->pluck('luaran', 'id')->prepend(trans('global.pleaseSelect'), '');

        $skemas = RefSkema::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.outputSkemas.create', compact('outputs', 'skemas','refSkema_id'));
    }

    public function store(StoreOutputSkemaRequest $request, $refSkema_id)
    {
        $outputSkema = OutputSkema::create($request->all()+['skema_id' => $refSkema_id]);

        return redirect()->route('admin.ref-skemas.show',[$refSkema_id]);
    }

    public function edit($refSkema_id, OutputSkema $outputSkema)
    {
        abort_if(Gate::denies('output_skema_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $outputs = Output::all()->pluck('luaran', 'id')->prepend(trans('global.pleaseSelect'), '');

        $skemas = RefSkema::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $outputSkema->load('output', 'skema');

        return view('admin.outputSkemas.edit', compact('outputs', 'skemas', 'outputSkema','refSkema_id'));
    }

    public function update(UpdateOutputSkemaRequest $request,$refSkema_id, OutputSkema $outputSkema)
    {
        $outputSkema->update($request->all());

        return redirect()->route('admin.output-skemas.index');
    }

    public function show($refSkema_id, OutputSkema $outputSkema)
    {
        abort_if(Gate::denies('output_skema_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $outputSkema->load('output', 'skema', 'outputSkemaPenelitianOutputs', 'outputSkemaPengabdianOutputs');

        return view('admin.outputSkemas.show', compact('outputSkema','refSkema_id'));
    }

    public function destroy($refSkema_id, OutputSkema $outputSkema)
    {
        abort_if(Gate::denies('output_skema_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $outputSkema->delete();

        return back();
    }

    public function massDestroy(MassDestroyOutputSkemaRequest $request, $refSkema_id)
    {
        OutputSkema::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
