<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Dosen;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfilController extends Controller
{
    public function index()
    {
        // abort_if(Gate::denies('user_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = auth()->user();

        return view('profil.index', compact('user'));
    }

    public function create()
    {
    }

    public function store(StoreUserRequest $request)
    {
    }

    public function edit(User $user)
    {
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $input = $request->only(['email']);
        $user->fill($input)->save();

        $dosen = Dosen::find($id);
        $input = $request->only(['nip','tempat_lahir','tanggal_lahir','email','telepon']);
        $dosen->fill($input)->save();


        return redirect()->route('profil.index');
    }

    public function show(User $user)
    {
    }

    public function destroy(User $user)
    {
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
    }
}
