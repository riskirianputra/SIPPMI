<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePenelitianRequest;
use App\Http\Requests\UpdatePenelitianRequest;
use App\Http\Resources\Admin\PenelitianResource;
use App\Penelitian;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PenelitianApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('penelitian_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PenelitianResource(Penelitian::with(['skema', 'kode_rumpun', 'prodi', 'tahapan', 'created_by'])->get());
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

        return (new PenelitianResource($penelitian))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Penelitian $penelitian)
    {
        abort_if(Gate::denies('penelitian_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PenelitianResource($penelitian->load(['skema', 'kode_rumpun', 'prodi', 'tahapan', 'created_by']));
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

        return (new PenelitianResource($penelitian))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Penelitian $penelitian)
    {
        abort_if(Gate::denies('penelitian_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $penelitian->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
