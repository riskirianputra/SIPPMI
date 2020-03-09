<?php

namespace App\Http\Controllers\Admin;

use App\Dosen;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDosenRequest;
use App\Http\Requests\StoreDosenRequest;
use App\Http\Requests\UpdateDosenRequest;
use App\Prodi;
use App\Role;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DosenController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('dosen_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dosens = Dosen::all();

        return view('admin.dosens.index', compact('dosens'));
    }

    public function create()
    {
        abort_if(Gate::denies('dosen_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prodis = Prodi::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.dosens.create', compact('prodis'));
    }

    public function store(StoreDosenRequest $request)
    {
        $user = new User();
        $user->name = request('nama');
        $user->email = request('email');
        $user->password = bcrypt(request('nidn'));
        $user->username = request('nidn');
        $user->type = 'D';
        $user->save();

        $role = Role::where('title', 'Dosen')->first();
        $user->roles()->sync([$role->id]);

        $dosen = Dosen::create(array_merge($request->all(), ['id' => $user->id]));

        return redirect()->route('admin.dosens.index');
    }

    public function edit(Dosen $dosen)
    {
        abort_if(Gate::denies('dosen_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prodis = Prodi::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $dosen->load('prodi');

        return view('admin.dosens.edit', compact('prodis', 'dosen'));
    }

    public function update(UpdateDosenRequest $request, Dosen $dosen)
    {
        $user = User::find($dosen->id);
        $user->name = request('nama');
        $user->email = request('email');
        $user->username = request('nidn');
        $user->save();

        $role = Role::where('title', 'Dosen')->first();
        $user->roles()->sync([$role->id]);

        $dosen->update($request->all());

        return redirect()->route('admin.dosens.index');
    }

    public function show(Dosen $dosen)
    {
        abort_if(Gate::denies('dosen_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dosen->load('prodi');

        return view('admin.dosens.show', compact('dosen'));
    }

    public function destroy(Dosen $dosen)
    {
        abort_if(Gate::denies('dosen_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dosen->delete();

        return back();
    }

    public function massDestroy(MassDestroyDosenRequest $request)
    {
        Dosen::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
