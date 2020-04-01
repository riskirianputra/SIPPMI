<?php

namespace App\Http\Controllers;

use App\Dosen;
use App\Penelitian;
use App\PenelitianAnggotum;
use App\Prodi;
use App\Usulan;
use App\UsulanAnggotum;
use Illuminate\Http\Request;

class PenelitianAnggotaController extends Controller
{
    public function create(Penelitian $penelitian)
    {
        $anggotas = $penelitian->usulan->anggotas()->tipe(1)->pluck('dosen_id', 'dosen_id')->toArray();
        $dosens = Dosen::whereNotIn('id',$anggotas)
            ->get()
            ->pluck('nama_nidn', 'id');
        $prodis = Prodi::pluck('nama','nama');

        return view('penelitians.anggota.create', compact('penelitian', 'dosens','prodis'));
    }

    public function store(Request $request, Penelitian $penelitian)
    {

        $this->validate($request, UsulanAnggotum::$dosen_validation_rule);

        $anggota = new UsulanAnggotum();
        $anggota->usulan_id = $penelitian->id;
        $anggota->dosen_id = $request->get('dosen_id');
        if($anggota->dosen_id == auth()->user()->id){
            $anggota->jabatan = 1;
        }else {
            $anggota->jabatan = 2;
        }
        $anggota->save();

        return redirect()->route('penelitian.anggota.create', [$penelitian]);
    }

    public function mahasiswaStore(Request $request, $id){
        $this->validate($request, UsulanAnggotum::$mahasiswa_validation_rule);

        $anggota = new UsulanAnggotum();
        $anggota->tipe = 2;
        $anggota->nama = $request->nama;
        $anggota->usulan_id = $id;
        $anggota->identifier = $request->identifier;
        $anggota->unit = $request->unit;
        $anggota->jabatan = 2;
        $anggota->save();

        return redirect()->back();
    }

    public function destroy(Penelitian $penelitian, UsulanAnggotum $anggotum)
    {
        $anggotum->delete();
        return back();
    }
}
