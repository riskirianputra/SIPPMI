<?php

namespace App\Http\Controllers;

use App\Dosen;
use App\Pengabdian;
use App\Prodi;
use App\UsulanAnggotum;
use Illuminate\Http\Request;

class PengabdianAnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pengabdian $pengabdian)
    {
        $anggotas = $pengabdian->usulan->anggotas()->tipe(1)->pluck('dosen_id', 'dosen_id')->toArray();
        $dosens = Dosen::whereNotIn('id',$anggotas)
            ->get()
            ->pluck('nama_nidn', 'id');
        $prodis = Prodi::pluck('nama','nama');

        return view('pengabdians.anggota.create', compact('pengabdian', 'dosens','prodis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pengabdian $pengabdian)
    {
        $anggotas = $pengabdian->usulan->anggotas()->tipe(1)->pluck('dosen_id', 'dosen_id')->toArray();
        $dosens = Dosen::whereNotIn('id',$anggotas)
            ->get()
            ->pluck('nama_nidn', 'id');
        $prodis = Prodi::pluck('nama','nama');

        return view('pengabdians.anggota.create', compact('pengabdian', 'dosens','prodis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pengabdian $pengabdian)
    {
        $this->validate($request, UsulanAnggotum::$dosen_validation_rule);

        $anggota = new UsulanAnggotum();
        $anggota->usulan_id = $pengabdian->id;
        $anggota->dosen_id = $request->get('dosen_id');
        if($anggota->dosen_id == auth()->user()->id){
            $anggota->jabatan = 1;
        }else {
            $anggota->jabatan = 2;
        }
        $anggota->save();

        return redirect()->route('pengabdian.anggota.create', [$pengabdian]);
    }

    public function mahasiswaStore(Request $request, $id){
        $this->validate($request, UsulanAnggotum::$mahasiswa_validation_rule);

        $anggota = new UsulanAnggotum();
        $anggota->tipe = 2;
        $anggota->nama = $request->nama;
        $anggota->usulan_id = $id;
        $anggota->identifier = $request->identifier;
        $anggota->unit = $request->unit;
        $anggota->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengabdian $pengabdian, UsulanAnggotum $anggotum)
    {
        $anggotum->delete();
        return back();
    }
}
