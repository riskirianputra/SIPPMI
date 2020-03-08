<?php

namespace App\Http\Controllers\Admin;

use App\BiayaSkema;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPenelitianBiayaRequest;
use App\Http\Requests\StorePenelitianBiayaRequest;
use App\Http\Requests\UpdatePenelitianBiayaRequest;
use App\Penelitian;
use App\PenelitianBiaya;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PenelitianBiayaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('penelitian_biaya_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $penelitianBiayas = PenelitianBiaya::all();

        return view('admin.penelitianBiayas.index', compact('penelitianBiayas'));
    }

    public function create()
    {
        abort_if(Gate::denies('penelitian_biaya_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $biaya_skemas = BiayaSkema::all()->pluck('persen_max', 'id')->prepend(trans('global.pleaseSelect'), '');

        $penelitians = Penelitian::all()->pluck('judul', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.penelitianBiayas.create', compact('biaya_skemas', 'penelitians'));
    }

    public function store(StorePenelitianBiayaRequest $request)
    {
        $penelitianBiaya = PenelitianBiaya::create($request->all());

        return redirect()->route('admin.penelitian-biayas.index');
    }

    public function edit(PenelitianBiaya $penelitianBiaya)
    {
        abort_if(Gate::denies('penelitian_biaya_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $biaya_skemas = BiayaSkema::all()->pluck('persen_max', 'id')->prepend(trans('global.pleaseSelect'), '');

        $penelitians = Penelitian::all()->pluck('judul', 'id')->prepend(trans('global.pleaseSelect'), '');

        $penelitianBiaya->load('biaya_skema', 'penelitian');

        return view('admin.penelitianBiayas.edit', compact('biaya_skemas', 'penelitians', 'penelitianBiaya'));
    }

    public function update(UpdatePenelitianBiayaRequest $request, PenelitianBiaya $penelitianBiaya)
    {
        $penelitianBiaya->update($request->all());

        return redirect()->route('admin.penelitian-biayas.index');
    }

    public function show(PenelitianBiaya $penelitianBiaya)
    {
        abort_if(Gate::denies('penelitian_biaya_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $penelitianBiaya->load('biaya_skema', 'penelitian');

        return view('admin.penelitianBiayas.show', compact('penelitianBiaya'));
    }

    public function destroy(PenelitianBiaya $penelitianBiaya)
    {
        abort_if(Gate::denies('penelitian_biaya_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $penelitianBiaya->delete();

        return back();
    }

    public function massDestroy(MassDestroyPenelitianBiayaRequest $request)
    {
        PenelitianBiaya::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
