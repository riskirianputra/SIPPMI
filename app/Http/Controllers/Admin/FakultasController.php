<?php

namespace App\Http\Controllers\Admin;

use App\Fakultum;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFakultumRequest;
use App\Http\Requests\StoreFakultumRequest;
use App\Http\Requests\UpdateFakultumRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FakultasController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('fakultum_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fakulta = Fakultum::all();

        return view('admin.fakulta.index', compact('fakulta'));
    }

    public function create()
    {
        abort_if(Gate::denies('fakultum_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fakulta.create');
    }

    public function store(StoreFakultumRequest $request)
    {
        $fakultum = Fakultum::create($request->all());

        return redirect()->route('admin.fakulta.index');
    }

    public function edit(Fakultum $fakultum)
    {
        abort_if(Gate::denies('fakultum_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fakulta.edit', compact('fakultum'));
    }

    public function update(UpdateFakultumRequest $request, Fakultum $fakultum)
    {
        $fakultum->update($request->all());

        return redirect()->route('admin.fakulta.index');
    }

    public function destroy(Fakultum $fakultum)
    {
        abort_if(Gate::denies('fakultum_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fakultum->delete();

        return back();
    }

    public function massDestroy(MassDestroyFakultumRequest $request)
    {
        Fakultum::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
