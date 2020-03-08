<?php

namespace App\Http\Controllers\Admin;

use App\BiayaSkema;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBiayaSkemaRequest;
use App\Http\Requests\StoreBiayaSkemaRequest;
use App\Http\Requests\UpdateBiayaSkemaRequest;
use App\KomponenBiaya;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BiayaSkemaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = BiayaSkema::with(['biaya'])->select(sprintf('%s.*', (new BiayaSkema)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'biaya_skema_show';
                $editGate      = 'biaya_skema_edit';
                $deleteGate    = 'biaya_skema_delete';
                $crudRoutePart = 'biaya-skemas';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->addColumn('biaya_nama', function ($row) {
                return $row->biaya ? $row->biaya->nama : '';
            });

            $table->editColumn('persen_max', function ($row) {
                return $row->persen_max ? $row->persen_max : "";
            });
            $table->editColumn('persen_min', function ($row) {
                return $row->persen_min ? $row->persen_min : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'biaya']);

            return $table->make(true);
        }

        return view('admin.biayaSkemas.index');
    }

    public function create()
    {
        abort_if(Gate::denies('biaya_skema_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $biayas = KomponenBiaya::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.biayaSkemas.create', compact('biayas'));
    }

    public function store(StoreBiayaSkemaRequest $request)
    {
        $biayaSkema = BiayaSkema::create($request->all());

        return redirect()->route('admin.biaya-skemas.index');
    }

    public function edit(BiayaSkema $biayaSkema)
    {
        abort_if(Gate::denies('biaya_skema_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $biayas = KomponenBiaya::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $biayaSkema->load('biaya');

        return view('admin.biayaSkemas.edit', compact('biayas', 'biayaSkema'));
    }

    public function update(UpdateBiayaSkemaRequest $request, BiayaSkema $biayaSkema)
    {
        $biayaSkema->update($request->all());

        return redirect()->route('admin.biaya-skemas.index');
    }

    public function show(BiayaSkema $biayaSkema)
    {
        abort_if(Gate::denies('biaya_skema_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $biayaSkema->load('biaya', 'biayaSkemaPenelitianBiayas', 'biayaSkemaPengabdianBiayas');

        return view('admin.biayaSkemas.show', compact('biayaSkema'));
    }

    public function destroy(BiayaSkema $biayaSkema)
    {
        abort_if(Gate::denies('biaya_skema_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $biayaSkema->delete();

        return back();
    }

    public function massDestroy(MassDestroyBiayaSkemaRequest $request)
    {
        BiayaSkema::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
