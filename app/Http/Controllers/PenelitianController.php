<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\V1\Admin\UsulanApiController;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPenelitianRequest;
use App\Http\Requests\StorePenelitianRequest;
use App\Http\Requests\UpdatePenelitianRequest;
use App\KodeRumpun;
use App\Penelitian;
use App\PenelitianAnggotum;
use App\PrnFokus;
use App\Prodi;
use App\RefSkema;
use App\RipTahapan;
use App\Usulan;
use App\UsulanAnggota;
use App\UsulanAnggotum;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Gate;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PenelitianController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('penelitian_user_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $anggotas = UsulanAnggotum::where('dosen_id', auth()->user()->id)->get()->pluck('usulan_id')->toArray();
        $penelitians = Penelitian::whereIn('id', $anggotas)->get();
        $penelitians->load('usulan');

        return view('penelitians.index', compact('penelitians'));
    }

    public function create()
    {
        abort_if(Gate::denies('penelitian_user_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $skemas = auth()->user()
            ->dosen
            ->skemas()
            ->where('jenis_usulan', Usulan::PENELITIAN)
            ->get()
            ->pluck('nama', 'id');

        if($skemas->count() <= 0){
            $skemas = RefSkema::where('jenis_usulan', Usulan::PENELITIAN)
                ->whereAvailable()
                ->get()
                ->pluck('nama', 'id');
        }

        $prnFokus = PrnFokus::pluck('nama','id')
            ->prepend(trans('global.pleaseSelect'), '');

        $kode_rumpuns = KodeRumpun::where('level', 3)
            ->get()
            ->pluck('rumpun_ilmu', 'id')
            ->prepend(trans('global.pleaseSelect'), '');

        $prodis = Prodi::all()
            ->pluck('fakultas_prodi', 'id')
            ->prepend(trans('global.pleaseSelect'), '');

        return view('penelitians.create', compact('skemas', 'kode_rumpuns', 'prodis','prnFokus'));
    }

    public function store(StorePenelitianRequest $request)
    {
        abort_if(Gate::denies('penelitian_user_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        // Tambah usulan
        $usulan = new Usulan();
        $usulan->pengusul_id = auth()->user()->id;
        $usulan->status_usulan = 0;
        $usulan->jenis_usulan = 'P';
        $usulan->save();

        // Tambah data penelitian
        $penelitian = Penelitian::create(array_merge($request->all(), ['id' => $usulan->id, 'tahun' => date('Y')]));

        $penelitian = Penelitian::findOrFail($usulan->id);

        $this->addFile($penelitian, $request, 'file_pengesahan', config('sippmi.path.pengesahan'));
        $this->addFile($penelitian, $request, 'file_proposal', config('sippmi.path.proposal'));
        $this->addFile($penelitian, $request, 'file_cv', config('sippmi.path.cv'));

        //Add ketua penelitian
        $anggota = new UsulanAnggotum();
        $anggota->tipe = PenelitianAnggotum::DOSEN;
        $anggota->usulan_id = $usulan->id;
        $anggota->dosen_id = auth()->user()->id;
        $anggota->jabatan = PenelitianAnggotum::KETUA;
        $anggota->save();

//        dd('a');

        return redirect()->route('penelitians.eksekutif', [$anggota->usulan_id]);
    }

    public function edit(Penelitian $penelitian)
    {
        abort_if(Gate::denies('penelitian_user_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $skemas = auth()->user()
            ->dosen
            ->skemas()
            ->where('jenis_usulan', Usulan::PENELITIAN)
            ->get()
            ->pluck('nama', 'id');

        if($skemas->count() <= 0){
            $skemas = RefSkema::where('jenis_usulan', Usulan::PENELITIAN)
                ->whereAvailable()
                ->get()
                ->pluck('nama', 'id');
        }

        $prnFokus = PrnFokus::pluck('nama','id')
            ->prepend(trans('global.pleaseSelect'), '');

        $kode_rumpuns = KodeRumpun::where('level', 3)
            ->get()
            ->pluck('rumpun_ilmu', 'id')
            ->prepend(trans('global.pleaseSelect'), '');

        $prodis = Prodi::all()
            ->pluck('fakultas_prodi', 'id')
            ->prepend(trans('global.pleaseSelect'), '');

        $penelitian->load('skema', 'kode_rumpun', 'prodi');


        return view('penelitians.edit', compact('skemas', 'kode_rumpuns', 'prodis', 'penelitian','prnFokus'));
    }

    public function update(UpdatePenelitianRequest $request, Penelitian $penelitian)
    {
        abort_if(Gate::denies('penelitian_user_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $penelitian->update($request->all());

        $this->addFile($penelitian, $request, 'file_pengesahan', config('sippmi.path.pengesahan'));
        $this->addFile($penelitian, $request, 'file_proposal', config('sippmi.path.proposal'));
        $this->addFile($penelitian, $request, 'file_cv', config('sippmi.path.cv'));

        return redirect()->route('penelitians.eksekutif', [$penelitian->id]);
    }

    public function show(Penelitian $penelitian)
    {
        abort_if(Gate::denies('penelitian_user_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $penelitian->load('skema', 'kode_rumpun', 'prodi', 'tahapan');

        return view('penelitians.show', compact('penelitian'));
    }

    public function destroy(Penelitian $penelitian)
    {
        abort_if(Gate::denies('penelitian_user_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $penelitian->delete();

        return back();
    }

    public function massDestroy(MassDestroyPenelitianRequest $request)
    {
        Penelitian::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function eksekutif(Penelitian $penelitian)
    {
        if ($penelitian->owner == auth()->user()->id) {
            $usulan = $penelitian->usulan;

            return view('penelitians.eksekutif', compact('penelitian', 'usulan'));
        }
        return back();
    }

    public function storeringkasan(Request $request, Penelitian $penelitian)
    {
        if ($penelitian->owner == auth()->user()->id) {
            $penelitian->ringkasan_eksekutif = request('ringkasan_eksekutif');
            $penelitian->save();

            return redirect()->route('penelitian.anggota.create', [$penelitian->id]);
        }
    }

    public function review(Request $request, Penelitian $penelitian)
    {
        $skema = RefSkema::findOrFail($penelitian->skema_id);

        $data = [
            'anggota' => $penelitian->usulan->anggotas()->count(),
            'anggota_mahasiswa' => $penelitian->usulan->anggotas()->tipe(2)->count()
        ];

        Validator::make($data, [
            'anggota' => 'integer|min:'.$skema->anggota_min.'|max:'.$skema->anggota_max,
            'anggota_mahasiswa' => 'integer|min:'.$skema->mahasiswa_min.'|max:'.$skema->mahasiswa_max
        ])->validate();

        if ($penelitian->usulan->pengusul_id == auth()->user()->id) {
            $usulan = $penelitian->usulan;
            return view('penelitians.review', compact('penelitian', 'usulan'));
        }
        return back();
    }

    public function submit(Request $request, Penelitian $penelitian)
    {
        if ($penelitian->owner == auth()->user()->id) {
            $usulan = $penelitian->usulan;
            $usulan->status_usulan = 1;
            $usulan->save();

            return redirect()->route('penelitians.show', [$penelitian->id]);
        }
        return back();
    }

}
