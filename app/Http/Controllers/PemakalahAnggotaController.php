<?php

namespace App\Http\Controllers;

use App\Dosen;
use App\Pemakalah;
use App\UsulanAnggotum;
use Illuminate\Http\Request;

class PemakalahAnggotaController extends Controller
{

    public function create(Pemakalah $pemakalah)
    {
        $anggotas = $pemakalah->authors()->tipe(1)->pluck('dosen_id', 'dosen_id')->toArray();
        $dosens = Dosen::whereNotIn('id', $anggotas)
            ->get()
            ->pluck('nama_nidn', 'id');

        return view('kinerjas.pemakalahs.anggotas.create', compact('pemakalah', 'dosens'));
    }

    public function store(Request $request, Pemakalah $pemakalah)
    {
        $this->validate($request, UsulanAnggotum::$dosen_validation_rule);

        $anggota = new UsulanAnggotum();
        $anggota->tipe = 1;
        $anggota->usulan_id = $pemakalah->id;
        $anggota->dosen_id = $request->get('dosen_id');
        if($anggota->dosen_id == auth()->user()->id){
            $anggota->jabatan = 11;
        }else {
            $anggota->jabatan = 12;
        }
        $anggota->save();

        return redirect()->route('pemakalah.anggota.create', [$pemakalah]);
    }

    public function mahasiswaStore(Request $request, $id){
        $anggota = new UsulanAnggotum();
        $anggota->tipe = 2;
        $anggota->nama = $request->nama;
        $anggota->usulan_id = $id;
        $anggota->identifier = $request->identifier;
        $anggota->unit = $request->unit;
        $anggota->jabatan = 12;
        $anggota->save();

        return redirect()->back();
    }

    public function destroy(Pemakalah $pemakalah, UsulanAnggotum $anggotum)
    {
        $anggotum->delete();
        return back();
    }
}
