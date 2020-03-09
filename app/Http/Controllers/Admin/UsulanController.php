<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUsulanRequest;
use App\Http\Requests\StoreUsulanRequest;
use App\Http\Requests\UpdateUsulanRequest;
use App\User;
use App\Usulan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsulanController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('usulan_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usulans = Usulan::all();

        return view('admin.usulans.index', compact('usulans'));
    }

    public function create()
    {
        abort_if(Gate::denies('usulan_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pengusuls = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.usulans.create', compact('pengusuls'));
    }

    public function store(StoreUsulanRequest $request)
    {
        $usulan = Usulan::create($request->all());

        return redirect()->route('admin.usulans.index');
    }

    public function edit(Usulan $usulan)
    {
        abort_if(Gate::denies('usulan_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pengusuls = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $usulan->load('pengusul');

        return view('admin.usulans.edit', compact('pengusuls', 'usulan'));
    }

    public function update(UpdateUsulanRequest $request, Usulan $usulan)
    {
        $usulan->update($request->all());

        return redirect()->route('admin.usulans.index');
    }

    public function show(Usulan $usulan)
    {
        abort_if(Gate::denies('usulan_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usulan->load('pengusul');

        return view('admin.usulans.show', compact('usulan'));
    }

    public function destroy(Usulan $usulan)
    {
        abort_if(Gate::denies('usulan_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usulan->delete();

        return back();
    }

    public function massDestroy(MassDestroyUsulanRequest $request)
    {
        Usulan::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
