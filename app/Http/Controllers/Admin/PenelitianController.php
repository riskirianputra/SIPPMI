<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PenelitianExport;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPenelitianRequest;
use App\Http\Requests\StorePenelitianRequest;
use App\Http\Requests\UpdatePenelitianRequest;
use App\KodeRumpun;
use App\Penelitian;
use App\Prodi;
use App\RefSkema;
use App\RipTahapan;
use App\Usulan;
use Gate;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PenelitianController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('penelitian_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $penelitians = Penelitian::all();

        $tahun_penelitians = Penelitian::selectRaw('distinct(tahun) as tahun')
            ->get()
            ->pluck('tahun', 'tahun');
        $skema_penelitians = RefSkema::where('jenis_usulan', Usulan::PENELITIAN)
            ->get()
            ->pluck('nama', 'id');

        return view('admin.penelitians.index',
            compact('penelitians', 'skema_penelitians', 'tahun_penelitians'));
    }

    public function filter(Request $request)
    {
        abort_if(Gate::denies('penelitian_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tahun = request('tahun');
        $skema = request('skema');

        if ($request->has('export')) {
            if (!empty($skema)) {
                $skema_name = RefSkema::findOrFail($skema)->nama;
                $filename = 'penelitian-' . $skema_name . '-' . $tahun . '.xlsx';
            } else {
                $filename = 'penelitian-all-' . $tahun . '.xlsx';
            }
            return Excel::download(new PenelitianExport($skema, $tahun), $filename);
        }

        $query = Penelitian::whereNotNull('created_at');

        if (!empty($tahun)) {
            $query = Penelitian::where('tahun', $tahun);
        }

        if (!empty($skema)) {
            $query->where('skema_id', $skema);
        }
        $penelitians = $query->get();

        $tahun_penelitians = Penelitian::selectRaw('distinct(year(created_at)) as tahun')
            ->get()
            ->pluck('tahun', 'tahun');
        $skema_penelitians = RefSkema::where('jenis_usulan', Usulan::PENELITIAN)
            ->get()
            ->pluck('nama', 'id');

        return view('admin.penelitians.index',
            compact('penelitians', 'skema_penelitians', 'tahun_penelitians', 'tahun', 'skema'));
    }

    public function create()
    {
        abort_if(Gate::denies('penelitian_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $skemas = RefSkema::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kode_rumpuns = KodeRumpun::all()->pluck('rumpun_ilmu', 'id')->prepend(trans('global.pleaseSelect'), '');

        $prodis = Prodi::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tahapans = RipTahapan::all()->pluck('tahun', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.penelitians.create', compact('skemas', 'kode_rumpuns', 'prodis', 'tahapans'));
    }

    public function store(StorePenelitianRequest $request)
    {
        $penelitian = Penelitian::create($request->all());

        if ($request->input('file_proposal', false)) {
            $penelitian->addMedia(storage_path('tmp/uploads/' . $request->input('file_proposal')))->toMediaCollection('file_proposal');
        }

        if ($request->input('file_laporan_kemajuan', false)) {
            $penelitian->addMedia(storage_path('tmp/uploads/' . $request->input('file_laporan_kemajuan')))->toMediaCollection('file_laporan_kemajuan');
        }

        if ($request->input('file_laporan_keuangan', false)) {
            $penelitian->addMedia(storage_path('tmp/uploads/' . $request->input('file_laporan_keuangan')))->toMediaCollection('file_laporan_keuangan');
        }

        if ($request->input('file_profil_penelitian', false)) {
            $penelitian->addMedia(storage_path('tmp/uploads/' . $request->input('file_profil_penelitian')))->toMediaCollection('file_profil_penelitian');
        }

        if ($request->input('file_laporan_akhir', false)) {
            $penelitian->addMedia(storage_path('tmp/uploads/' . $request->input('file_laporan_akhir')))->toMediaCollection('file_laporan_akhir');
        }

        if ($request->input('file_logbook', false)) {
            $penelitian->addMedia(storage_path('tmp/uploads/' . $request->input('file_logbook')))->toMediaCollection('file_logbook');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $penelitian->id]);
        }

        return redirect()->route('admin.penelitians.index');
    }

    public function edit(Penelitian $penelitian)
    {
        abort_if(Gate::denies('penelitian_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $skemas = RefSkema::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kode_rumpuns = KodeRumpun::all()->pluck('rumpun_ilmu', 'id')->prepend(trans('global.pleaseSelect'), '');

        $prodis = Prodi::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tahapans = RipTahapan::all()->pluck('tahun', 'id')->prepend(trans('global.pleaseSelect'), '');

        $penelitian->load('skema', 'kode_rumpun', 'prodi', 'tahapan', 'created_by');

        return view('admin.penelitians.edit', compact('skemas', 'kode_rumpuns', 'prodis', 'tahapans', 'penelitian'));
    }

    public function update(UpdatePenelitianRequest $request, Penelitian $penelitian)
    {
        $penelitian->update($request->all());

        if ($request->input('file_proposal', false)) {
            if (!$penelitian->file_proposal || $request->input('file_proposal') !== $penelitian->file_proposal->file_name) {
                $penelitian->addMedia(storage_path('tmp/uploads/' . $request->input('file_proposal')))->toMediaCollection('file_proposal');
            }
        } elseif ($penelitian->file_proposal) {
            $penelitian->file_proposal->delete();
        }

        if ($request->input('file_laporan_kemajuan', false)) {
            if (!$penelitian->file_laporan_kemajuan || $request->input('file_laporan_kemajuan') !== $penelitian->file_laporan_kemajuan->file_name) {
                $penelitian->addMedia(storage_path('tmp/uploads/' . $request->input('file_laporan_kemajuan')))->toMediaCollection('file_laporan_kemajuan');
            }
        } elseif ($penelitian->file_laporan_kemajuan) {
            $penelitian->file_laporan_kemajuan->delete();
        }

        if ($request->input('file_laporan_keuangan', false)) {
            if (!$penelitian->file_laporan_keuangan || $request->input('file_laporan_keuangan') !== $penelitian->file_laporan_keuangan->file_name) {
                $penelitian->addMedia(storage_path('tmp/uploads/' . $request->input('file_laporan_keuangan')))->toMediaCollection('file_laporan_keuangan');
            }
        } elseif ($penelitian->file_laporan_keuangan) {
            $penelitian->file_laporan_keuangan->delete();
        }

        if ($request->input('file_profil_penelitian', false)) {
            if (!$penelitian->file_profil_penelitian || $request->input('file_profil_penelitian') !== $penelitian->file_profil_penelitian->file_name) {
                $penelitian->addMedia(storage_path('tmp/uploads/' . $request->input('file_profil_penelitian')))->toMediaCollection('file_profil_penelitian');
            }
        } elseif ($penelitian->file_profil_penelitian) {
            $penelitian->file_profil_penelitian->delete();
        }

        if ($request->input('file_laporan_akhir', false)) {
            if (!$penelitian->file_laporan_akhir || $request->input('file_laporan_akhir') !== $penelitian->file_laporan_akhir->file_name) {
                $penelitian->addMedia(storage_path('tmp/uploads/' . $request->input('file_laporan_akhir')))->toMediaCollection('file_laporan_akhir');
            }
        } elseif ($penelitian->file_laporan_akhir) {
            $penelitian->file_laporan_akhir->delete();
        }

        if ($request->input('file_logbook', false)) {
            if (!$penelitian->file_logbook || $request->input('file_logbook') !== $penelitian->file_logbook->file_name) {
                $penelitian->addMedia(storage_path('tmp/uploads/' . $request->input('file_logbook')))->toMediaCollection('file_logbook');
            }
        } elseif ($penelitian->file_logbook) {
            $penelitian->file_logbook->delete();
        }

        return redirect()->route('admin.penelitians.index');
    }

    public function show(Penelitian $penelitian)
    {
        abort_if(Gate::denies('penelitian_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $penelitian->load('skema', 'kode_rumpun', 'prodi', 'tahapan');

        return view('admin.penelitians.show', compact('penelitian'));
    }

    public function destroy(Penelitian $penelitian)
    {
        abort_if(Gate::denies('penelitian_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $penelitian->delete();

        return back();
    }

    public function massDestroy(MassDestroyPenelitianRequest $request)
    {
        Penelitian::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('penelitian_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new Penelitian();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media', 'public');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
