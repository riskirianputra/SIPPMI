<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyKomponenBiayaRequest;
use App\Http\Requests\StoreKomponenBiayaRequest;
use App\Http\Requests\UpdateKomponenBiayaRequest;
use App\KomponenBiaya;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class KomponenBiayaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = KomponenBiaya::query()->select(sprintf('%s.*', (new KomponenBiaya)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'komponen_biaya_show';
                $editGate      = 'komponen_biaya_edit';
                $deleteGate    = 'komponen_biaya_delete';
                $crudRoutePart = 'komponen-biayas';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('nama', function ($row) {
                return $row->nama ? $row->nama : "";
            });
            $table->editColumn('keterangan', function ($row) {
                return $row->keterangan ? $row->keterangan : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.komponenBiayas.index');
    }

    public function create()
    {
        abort_if(Gate::denies('komponen_biaya_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.komponenBiayas.create');
    }

    public function store(StoreKomponenBiayaRequest $request)
    {
        $komponenBiaya = KomponenBiaya::create($request->all());

        return redirect()->route('admin.komponen-biayas.index');
    }

    public function edit(KomponenBiaya $komponenBiaya)
    {
        abort_if(Gate::denies('komponen_biaya_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.komponenBiayas.edit', compact('komponenBiaya'));
    }

    public function update(UpdateKomponenBiayaRequest $request, KomponenBiaya $komponenBiaya)
    {
        $komponenBiaya->update($request->all());

        return redirect()->route('admin.komponen-biayas.index');
    }

    public function show(KomponenBiaya $komponenBiaya)
    {
        abort_if(Gate::denies('komponen_biaya_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $komponenBiaya->load('biayaBiayaSkemas');

        return view('admin.komponenBiayas.show', compact('komponenBiaya'));
    }

    public function destroy(KomponenBiaya $komponenBiaya)
    {
        abort_if(Gate::denies('komponen_biaya_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $komponenBiaya->delete();

        return back();
    }

    public function massDestroy(MassDestroyKomponenBiayaRequest $request)
    {
        KomponenBiaya::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
