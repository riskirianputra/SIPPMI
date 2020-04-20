<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyKodeRumpunRequest;
use App\Http\Requests\StoreKodeRumpunRequest;
use App\Http\Requests\UpdateKodeRumpunRequest;
use App\KodeRumpun;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KodeRumpunController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('kode_rumpun_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kodeRumpuns = KodeRumpun::all();

        return view('admins.referensis.kode_rumpuns.index', compact('kodeRumpuns'));
    }

    public function create()
    {
        abort_if(Gate::denies('kode_rumpun_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admins.referensis.kode_rumpuns.create');
    }

    public function store(StoreKodeRumpunRequest $request)
    {
        $kodeRumpun = KodeRumpun::create($request->all());

        return redirect()->route('admin.kode-rumpuns.index');
    }

    public function edit(KodeRumpun $kodeRumpun)
    {
        abort_if(Gate::denies('kode_rumpun_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admins.referensis.kode_rumpuns.edit', compact('kodeRumpun'));
    }

    public function update(UpdateKodeRumpunRequest $request, KodeRumpun $kodeRumpun)
    {
        $kodeRumpun->update($request->all());

        return redirect()->route('admin.kode-rumpuns.index');
    }

    public function show(KodeRumpun $kodeRumpun)
    {
        abort_if(Gate::denies('kode_rumpun_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kodeRumpun->load('kodeRumpunPenelitians', 'kodeRumpunPengabdians');

        return view('admins.referensis.kode_rumpuns.show', compact('kodeRumpun'));
    }

    public function destroy(KodeRumpun $kodeRumpun)
    {
        abort_if(Gate::denies('kode_rumpun_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kodeRumpun->delete();

        return redirect()->route('admin.kode-rumpuns.index');
    }

    public function massDestroy(MassDestroyKodeRumpunRequest $request)
    {
        KodeRumpun::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
