<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function edit()
    {
        $user = auth()->user();

        return view('profil.password', compact('user'));
    }

    public function update(Request $request){

        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password'
        ]);

        $user = User::findOrFail(auth()->user()->id);
        if (Hash::check($request->old_password, $user->password)) {
            $user->password = bcrypt($request->new_password);
            if ($user->save()) {
                session()->flash('success', 'Berhasil mengubah password');
                return redirect()->route('profil.index');
            }
        }
        session()->flash('error', 'Gagal mengubah password');
        return redirect()->route('password.edit');

    }
}
