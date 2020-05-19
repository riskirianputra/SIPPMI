<?php

namespace App\Http\Controllers;

use App\Pemakalah;
use App\Usulan;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class PemakalahController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('kinerja_user_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $makalahs = Pemakalah::whereHas('authors', function (Builder $query) {
            $query->where('dosen_id', auth()->user()->id);
        })->get();

        return view('kinerjas.pemakalahs.index', compact('makalahs'));

    }

    public function create()
    {
        abort_if(Gate::denies('kinerja_user_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = Pemakalah::STATUS_PEMAKALAH;
        $levels = Pemakalah::LEVELS;

        return view('kinerjas.pemakalahs.create', compact('statuses', 'levels'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('kinerja_user_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // Tambah usulan
        $usulan = new Usulan();
        $usulan->pengusul_id = auth()->user()->id;
        $usulan->status_usulan = 0;
        $usulan->jenis_usulan = Usulan::PEMAKALAH;
        $usulan->save();

        $makalah = new Pemakalah();
        $makalah->id = $usulan->id;
        $makalah->judul = $request->get('judul');
        $makalah->tahun = $request->get('tahun');
        $makalah->nama_forum = $request->get('nama_forum');
        $makalah->status_pemakalah = $request->get('status_pemakalah');
        $makalah->penyelenggara = $request->get('penyelenggara');
        $makalah->tempat = $request->get('tempat');
        $makalah->tingkat = $request->get('tingkat');
        $makalah->tanggal_mulai = $request->get('tanggal_mulai');
        $makalah->tanggal_selesai = $request->get('tanggal_selesai');
        $makalah->verifikasi = Pemakalah::DRAFT;

        if ($makalah->save()) {
            $this->addFile($makalah, $request, 'file_artikel', config('sippmi.path.kinerja.makalah'));
            return redirect()->route('pemakalahs.anggota.create', [$makalah->id]);
        }
        return redirect()->back();
    }

    public function show(Pemakalah $pemakalah)
    {
        return view('kinerjas.pemakalahs.show', ['makalah' => $pemakalah]);
    }

    public function edit(Pemakalah $pemakalah)
    {
        abort_if(Gate::denies('kinerja_user_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = Pemakalah::STATUS_PEMAKALAH;
        $levels = Pemakalah::LEVELS;

        return view('kinerjas.pemakalahs.edit', compact('pemakalah', 'statuses', 'levels'));
    }

    public function update(Request $request, Pemakalah $pemakalah)
    {
        abort_if(Gate::denies('kinerja_user_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($pemakalah->owner != auth()->user()->id) {
            notify('error', 'Tidak diizinkan mengelola makalah orang lain');
            return redirect()->back();
        }

        $makalah = $pemakalah;
        $makalah->judul = $request->get('judul');
        $makalah->tahun = $request->get('tahun');
        $makalah->nama_forum = $request->get('nama_forum');
        $makalah->status_pemakalah = $request->get('status_pemakalah');
        $makalah->penyelenggara = $request->get('penyelenggara');
        $makalah->tempat = $request->get('tempat');
        $makalah->tingkat = $request->get('tingkat');
        $makalah->tanggal_mulai = $request->get('tanggal_mulai');
        $makalah->tanggal_selesai = $request->get('tanggal_selesai');

        if ($makalah->save()) {
            $this->addFile($makalah, $request, 'file_artikel', config('sippmi.path.kinerja.makalah'));
            return redirect()->route('pemakalahs.anggota.create', [$makalah->id]);
        }
        return redirect()->back();
    }

    public function destroy(Request $request, Pemakalah $pemakalah)
    {
        abort_if(Gate::denies('kinerja_user_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($pemakalah->owner != auth()->user()->id) {
            notify('error', 'Tidak diizinkan mengelola makalah orang lain');
            return redirect()->back();
        }

        $id = $pemakalah->id;
        $usulan = Usulan::find($id);

        if ($usulan->delete() && $pemakalah->delete()) {
            notify('success', 'Berhasil menghapus data makalah');
        }
    }

    public function review(Pemakalah $pemakalah)
    {

    }

    public function submit(Request $request, Pemakalah $pemakalah)
    {

    }
}
