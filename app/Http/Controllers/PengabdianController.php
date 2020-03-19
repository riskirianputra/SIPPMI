<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePengabdianRequest;
use App\Http\Requests\UpdatePengabdianRequest;
use App\KodeRumpun;
use App\Pengabdian;
use App\PengabdianAnggotum;
use App\PrnFokus;
use App\Prodi;
use App\RefSkema;
use App\Usulan;
use App\UsulanAnggotum;
use Illuminate\Http\Request;
use Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class PengabdianController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('pengabdian_user_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $anggotas = UsulanAnggotum::where('dosen_id', auth()->user()->id)->get()->pluck('usulan_id')->toArray();
//        dd($anggotas);
        $pengabdians = Pengabdian::whereIn('id', $anggotas)->get();

        $pengabdians->load('usulan');

        return view('pengabdians.index', compact('pengabdians'));
    }


    public function create()
    {
        abort_if(Gate::denies('penelitian_user_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $skemas = auth()->user()
            ->dosen
            ->skemas()
            ->where('jenis_usulan', Usulan::PENGABDIAN)
            ->get()
            ->pluck('nama', 'id')
            ->prepend(trans('global.pleaseSelect'));

        if($skemas->count() <= 0){
            $skemas = RefSkema::where('jenis_usulan', Usulan::PENGABDIAN)
                ->whereAvailable()
                ->get()
                ->pluck('nama', 'id')
                ->prepend(trans('global.pleaseSelect'), '');
        }

        $kode_rumpuns = KodeRumpun::where('level', 3)
            ->get()
            ->pluck('rumpun_ilmu', 'id')
            ->prepend(trans('global.pleaseSelect'), '');

        $prodis = Prodi::all()
            ->pluck('fakultas_prodi', 'id')
            ->prepend(trans('global.pleaseSelect'), '');

        return view('pengabdians.create', compact('skemas', 'kode_rumpuns', 'prodis'));
    }


    public function store(StorePengabdianRequest $request)
    {
        abort_if(Gate::denies('pengabdian_user_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

            // Tambah usulan
            $usulan = new Usulan();
            $usulan->pengusul_id = auth()->user()->id;
            $usulan->status_usulan = 0;
            $usulan->jenis_usulan = Usulan::PENGABDIAN;
            $usulan->save();

            $usulan_id = $usulan->id;

            // Tambah data penelitian
            Pengabdian::create(array_merge($request->all(), ['id' => $usulan->id, 'tahun' => date('Y')]));

            $pengabdian = Pengabdian::findOrFail($usulan->id);

            $this->addFile($pengabdian, $request, 'file_pengesahan', config('sippmi.path.pengesahan'));
            $this->addFile($pengabdian, $request, 'file_proposal', config('sippmi.path.proposal'));
            $this->addFile($pengabdian, $request, 'file_cv', config('sippmi.path.cv'));

            //Add ketua penelitian
            $anggota = new UsulanAnggotum();
            $anggota->tipe = UsulanAnggotum::DOSEN;
            $anggota->usulan_id = $usulan->id;
            $anggota->dosen_id = auth()->user()->id;
            $anggota->jabatan = UsulanAnggotum::KETUA;
            $anggota->save();

        return redirect()->route('pengabdians.eksekutif', [$usulan->id]);
    }

    public function eksekutif(Pengabdian $pengabdian)
    {
        if ($pengabdian->owner == auth()->user()->id) {
            $usulan = $pengabdian->usulan;

            return view('pengabdians.eksekutif', compact('pengabdian', 'usulan'));
        }
        return back();
    }

    public function storeringkasan(Request $request, Pengabdian $pengabdian)
    {
        if ($pengabdian->owner == auth()->user()->id) {
            $pengabdian->ringkasan_eksekutif = request('ringkasan_eksekutif');
            $pengabdian->save();

            return redirect()->route('pengabdian.anggota.create', [$pengabdian->id]);
        }
    }

    public function review(Request $request, Pengabdian $pengabdian)
    {
        $skema = RefSkema::findOrFail($pengabdian->skema_id);

        $data = [
            'anggota' => $pengabdian->usulan->anggotas()->count(),
            'anggota_mahasiswa' => $pengabdian->usulan->anggotas()->tipe(2)->count()
        ];


        Validator::make($data, [
            'anggota' => 'integer|min:'.$skema->anggota_min.'|max:'.$skema->anggota_max,
            'anggota_mahasiswa' => 'integer|min:'.$skema->mahasiswa_min.'|max:'.$skema->mahasiswa_max
        ])->validate();

        if ($pengabdian->owner == auth()->user()->id) {
            $usulan = $pengabdian->usulan;
            return view('pengabdians.review', compact('pengabdian', 'usulan'));
        }
        return back();
    }

    public function submit(Request $request, Pengabdian $pengabdian)
    {
        if ($pengabdian->owner == auth()->user()->id) {
            $usulan = $pengabdian->usulan;
            $usulan->status_usulan = 1;
            $usulan->save();

            return redirect()->route('pengabdians.show', [$pengabdian->id]);
        }
        return back();
    }


    public function show(Pengabdian $pengabdian)
    {
        abort_if(Gate::denies('pengabdian_user_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pengabdian->load('skema', 'kode_rumpun', 'prodi');

        return view('pengabdians.show', compact('pengabdian'));
    }


    public function edit(Pengabdian $pengabdian)
    {
        abort_if(Gate::denies('pengabdian_user_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $skemas = auth()->user()
            ->dosen
            ->skemas()
            ->where('jenis_usulan', Usulan::PENGABDIAN)
            ->get()
            ->pluck('nama', 'id')
            ->prepend(trans('global.pleaseSelect'));

        if($skemas->count() <= 0){
            $skemas = RefSkema::where('jenis_usulan', Usulan::PENGABDIAN)
                ->whereAvailable()
                ->get()
                ->pluck('nama', 'id')
                ->prepend(trans('global.pleaseSelect'), '');
        }


        $kode_rumpuns = KodeRumpun::where('level', 3)
            ->get()
            ->pluck('rumpun_ilmu', 'id')
            ->prepend(trans('global.pleaseSelect'), '');

        $prodis = Prodi::all()
            ->pluck('fakultas_prodi', 'id')
            ->prepend(trans('global.pleaseSelect'), '');

        $pengabdian->load('skema', 'kode_rumpun', 'prodi');


        return view('pengabdians.edit', compact('skemas', 'kode_rumpuns', 'prodis', 'pengabdian'));
    }


    public function update(UpdatePengabdianRequest $request, Pengabdian $pengabdian)
    {
        abort_if(Gate::denies('pengabdian_user_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pengabdian->update($request->all());

        $this->addFile($pengabdian, $request, 'file_pengesahan', config('sippmi.path.pengesahan'));
        $this->addFile($pengabdian, $request, 'file_proposal', config('sippmi.path.proposal'));
        $this->addFile($pengabdian, $request, 'file_cv', config('sippmi.path.cv'));


        return redirect()->route('pengabdians.eksekutif', [$pengabdian->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengabdian $pengabdian)
    {
        abort_if(Gate::denies('penelitian_user_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pengabdian->delete();

        return back();
    }
}
