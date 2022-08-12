<?php

namespace App\Http\Controllers\Admin;

use App\Dosen;
use App\Http\Controllers\Controller;
use App\RefSkema;
use App\Usulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DosenSkemaController extends Controller
{
    public function create(Dosen $dosen)
    {
        if (!Gate::allows('dosen_manage')) {
            return abort(401);
        }

        $dosen_skemas = $dosen->skemas->pluck('nama', 'id')->toArray();
        $skema_penelitians = RefSkema::where('jenis_usulan', Usulan::PENELITIAN)->get();
        $skema_pengabdians = RefSkema::where('jenis_usulan', Usulan::PENGABDIAN)->get();

        return view('admin.dosens.skemas.create', compact(
            'dosen',
            'skema_penelitians',
            'skema_pengabdians',
            'dosen_skemas'));
    }

    public function store(Request $request, Dosen $dosen)
    {
        if (!Gate::allows('dosen_manage')) {
            return abort(401);
        }

        $skemas = $request->input('skemas');

        $dosen->skemas()->sync($skemas);

        return redirect()->route('admin.dosens.skemas.create', [$dosen->id]);

    }
}
