<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PenelitianExport;
use App\Exports\PengabdianExport;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPengabdianRequest;
use App\Http\Requests\StorePengabdianRequest;
use App\Http\Requests\UpdatePengabdianRequest;
use App\KodeRumpun;
use App\Pengabdian;
use App\Prodi;
use App\RefSkema;
use App\Usulan;
use Gate;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;

class PengabdianController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('pengabdian_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pengabdians = Pengabdian::all();

        $tahun_pengabdians = Pengabdian::selectRaw('distinct(tahun) as tahun')
            ->get()
            ->pluck('tahun', 'tahun');
        $skema_pengabdians = RefSkema::where('jenis_usulan', Usulan::PENGABDIAN)
            ->get()
            ->pluck('nama', 'id');

        return view('admin.pengabdians.index',
            compact('pengabdians', 'skema_pengabdians', 'tahun_pengabdians'));
    }

    public function filter(Request $request)
    {
        abort_if(Gate::denies('pengabdian_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tahun = request('tahun');
        $skema = request('skema');

        if ($request->has('export')) {
            if (!empty($skema)) {
                $skema_name = RefSkema::findOrFail($skema)->nama;
                $filename = 'pengabdian-' . $skema_name . '-' . $tahun . '.xlsx';
            } else {
                $filename = 'pengabdian-all-' . $tahun . '.xlsx';
            }
            return Excel::download(new PengabdianExport($skema, $tahun), $filename);
        }

        $query = Pengabdian::whereNotNull('created_at');

        if (!empty($tahun)) {
            $query = Pengabdian::where('tahun', $tahun);
        }

        if (!empty($skema)) {
            $query->where('skema_id', $skema);
        }
        $pengabdians = $query->get();

        $tahun_pengabdians = Pengabdian::selectRaw('distinct(year(created_at)) as tahun')
            ->get()
            ->pluck('tahun', 'tahun');
        $skema_pengabdians = RefSkema::where('jenis_usulan', Usulan::PENGABDIAN)
            ->get()
            ->pluck('nama', 'id');

        return view('admin.pengabdians.index',
            compact('pengabdians', 'skema_pengabdians', 'tahun_pengabdians', 'tahun', 'skema'));
    }

    public function create()
    {
        abort_if(Gate::denies('pengabdian_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $skemas = RefSkema::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $prodis = Prodi::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kode_rumpuns = KodeRumpun::all()->pluck('rumpun_ilmu', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.pengabdians.create', compact('skemas', 'prodis', 'kode_rumpuns'));
    }

    public function store(StorePengabdianRequest $request)
    {
        $pengabdian = Pengabdian::create($request->all());

        if ($request->input('file_proposal', false)) {
            $pengabdian->addMedia(storage_path('tmp/uploads/' . $request->input('file_proposal')))->toMediaCollection('file_proposal');
        }

        if ($request->input('file_lembaran_pengesahan', false)) {
            $pengabdian->addMedia(storage_path('tmp/uploads/' . $request->input('file_lembaran_pengesahan')))->toMediaCollection('file_lembaran_pengesahan');
        }

        if ($request->input('file_laporan_kemajuan', false)) {
            $pengabdian->addMedia(storage_path('tmp/uploads/' . $request->input('file_laporan_kemajuan')))->toMediaCollection('file_laporan_kemajuan');
        }

        if ($request->input('file_laporan_keuangan', false)) {
            $pengabdian->addMedia(storage_path('tmp/uploads/' . $request->input('file_laporan_keuangan')))->toMediaCollection('file_laporan_keuangan');
        }

        if ($request->input('file_laporan_akhir', false)) {
            $pengabdian->addMedia(storage_path('tmp/uploads/' . $request->input('file_laporan_akhir')))->toMediaCollection('file_laporan_akhir');
        }

        if ($request->input('file_logbook', false)) {
            $pengabdian->addMedia(storage_path('tmp/uploads/' . $request->input('file_logbook')))->toMediaCollection('file_logbook');
        }

        if ($request->input('file_profile_pengabdian', false)) {
            $pengabdian->addMedia(storage_path('tmp/uploads/' . $request->input('file_profile_pengabdian')))->toMediaCollection('file_profile_pengabdian');
        }

        return redirect()->route('admin.pengabdians.index');
    }

    public function edit(Pengabdian $pengabdian)
    {
        abort_if(Gate::denies('pengabdian_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $skemas = RefSkema::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $prodis = Prodi::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kode_rumpuns = KodeRumpun::all()->pluck('rumpun_ilmu', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pengabdian->load('skema', 'prodi', 'kode_rumpun');

        return view('admin.pengabdians.edit', compact('skemas', 'prodis', 'kode_rumpuns', 'pengabdian'));
    }

    public function update(UpdatePengabdianRequest $request, Pengabdian $pengabdian)
    {
        $pengabdian->update($request->all());

        $this->addFile($pengabdian, $request, 'file_pengesahan', config('sippmi.path.pengesahan'));
        $this->addFile($pengabdian, $request, 'file_proposal', config('sippmi.path.proposal'));
        $this->addFile($pengabdian, $request, 'file_cv', config('sippmi.path.cv'));

        return redirect()->route('admin.pengabdians.index');
    }

    public function show(Pengabdian $pengabdian)
    {
        abort_if(Gate::denies('pengabdian_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pengabdian->load('skema', 'prodi', 'kode_rumpun', 'created_by', 'pengabdianPengabdianAnggota', 'pengabdianPengabdianOutputs', 'pengabdianPengabdianBiayas');

        return view('admin.pengabdians.show', compact('pengabdian'));
    }

    public function destroy(Pengabdian $pengabdian)
    {
        abort_if(Gate::denies('pengabdian_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pengabdian->delete();

        return back();
    }

    public function massDestroy(MassDestroyPengabdianRequest $request)
    {
        Pengabdian::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
