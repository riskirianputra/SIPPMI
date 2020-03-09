<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRefSkemaRequest;
use App\Http\Requests\StoreRefSkemaRequest;
use App\Http\Requests\UpdateRefSkemaRequest;
use App\RefSkema;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RefSkemaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ref_skema_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $refSkemas = RefSkema::all();

        return view('admin.refSkemas.index', compact('refSkemas'));
    }

    public function create()
    {
        abort_if(Gate::denies('ref_skema_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.refSkemas.create');
    }

    public function store(StoreRefSkemaRequest $request)
    {
        $refSkema = RefSkema::create($request->all());

        return redirect()->route('admin.ref-skemas.index');
    }

    public function edit(RefSkema $refSkema)
    {

        abort_if(Gate::denies('ref_skema_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.refSkemas.edit', compact('refSkema'));
    }

    public function update(UpdateRefSkemaRequest $request, RefSkema $refSkema)
    {

        $refSkema->update($request->all());

        return redirect()->route('admin.ref-skemas.index');
    }

    public function show(RefSkema $refSkema)
    {
        abort_if(Gate::denies('ref_skema_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $refSkema->load('skemaOutputSkemas', 'skemaPenelitians', 'skemaPengabdians');

        return view('admin.refSkemas.show', compact('refSkema'));
    }

    public function destroy(RefSkema $refSkema)
    {
        abort_if(Gate::denies('ref_skema_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $refSkema->delete();

        return back();
    }

    public function massDestroy(MassDestroyRefSkemaRequest $request)
    {
        RefSkema::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
