<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Penelitian;
use App\Usulan;
use App\UsulanKomentar;
use Illuminate\Http\Request;

class UsulanKomentarController extends Controller
{
    public function store(Request $request, Usulan $usulan)
    {
        $request->validate([
            'komentar' => 'required'
        ]);

        $komentar = UsulanKomentar::create([
            'komentar' => request('komentar'),
            'usulan_id' => $usulan->id,
        ]);

        return redirect()->route('admin.penelitians.show', $usulan->id);

    }

    public function edit(Usulan $usulan, UsulanKomentar $komentar)
    {
        $penelitian = Penelitian::find($usulan->id);
        return view('admin.usulanKomentars.edit', compact('penelitian', 'komentar'));
    }

    public function update(Request $request, Usulan $usulan, UsulanKomentar $komentar)
    {
        $request->validate([
            'komentar' => 'required'
        ]);

        $komentar->update([
            'komentar' => request('komentar'),
            'usulan_id' => $usulan->id,
            'status' => 0
        ]);

        return redirect()->route('admin.penelitians.show', $usulan->id);
    }

    public function destroy(Request $request, Usulan $usulan, UsulanKomentar $usulanKomentar)
    {
        $usulanKomentar->delete();
        $usulanKomentar->save();
        return redirect()->route('admin.penelitians.show', [$usulan->id]);
    }

    public function close($usulan_id, $komentar_id){
        $komentar = UsulanKomentar::find($usulan_id);
        $komentar->status = UsulanKomentar::CLOSED;
        $komentar->save();

        return redirect()->route('admin.penelitians.show', $usulan_id);
    }

    public function open($usulan_id, $komentar_id){
        $komentar = UsulanKomentar::find($usulan_id);
        $komentar->status = UsulanKomentar::OPEN;
        $komentar->save();

        return redirect()->route('admin.penelitians.show', $usulan_id);
    }
}
