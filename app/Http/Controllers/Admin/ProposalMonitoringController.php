<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProposalDosenExport;
use App\Http\Controllers\Controller;
use App\Penelitian;
use App\Usulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ProposalMonitoringController extends Controller
{
    public function dosen_index()
    {
        $tahun = date('Y');
        $tahuns = Penelitian::selectRaw('distinct(tahun) as tahun')
            ->get()
            ->pluck('tahun', 'tahun');
        $usulan = null;
        $usulans = Usulan::JENIS_USULAN;

        $dosens = collect([]);

        return view('admins.monitorings.proposals.dosen_index', compact(
            'dosens',
            'tahun',
            'tahuns',
            'usulan',
            'usulans'
        ));

    }


    public function dosen_filter(Request $request)
    {
        $tahun = $request->get('tahun');
        $usulan = $request->get('jenis_usulan');

        if ($request->has('export')) {
            return Excel::download(new ProposalDosenExport($tahun, $usulan), 'monitoring-'.$tahun.'.xlsx');
        }

        if($usulan == Usulan::PENELITIAN){
            $table = 'penelitians';
        }else if($usulan == Usulan::PENGABDIAN){
            $table = 'pengabdians';
        }

        $dosens = DB::table('usulan_anggota')
            ->selectRaw(
                'dosens.id,
                dosens.nama as nama,
                dosens.nidn as nidn,
                prodis.nama AS prodi,
                fakultas.nama AS fakultas,
                '.$table.'.tahun as tahun,
                SUM(case when usulan_anggota.jabatan = 1 then 1 ELSE 0 END) AS usulan_ketua,
                SUM(case when usulan_anggota.jabatan = 2 then 1 ELSE 0 END) AS usulan_anggota,
                COUNT(usulan_anggota.jabatan) AS usulan_total')
            ->leftJoin('usulans', 'usulans.id', '=', 'usulan_anggota.usulan_id')
            ->leftJoin($table, 'usulans.id', '=', $table.'.id')
            ->leftJoin('dosens', 'dosens.id', '=', 'usulan_anggota.dosen_id')
            ->leftJoin('prodis', 'prodis.id', '=', 'dosens.prodi_id')
            ->leftJoin('fakultas', 'fakultas.id', '=', 'prodis.fakultas_id')
            ->where($table.'.tahun', $tahun)
            ->whereNotNull($table.'.id')
            ->whereNull($table.'.deleted_at')
            ->where('usulan_anggota.tipe', 1)
            ->groupBy('dosens.id')
            ->get();

        $tahuns = Penelitian::selectRaw('distinct(tahun) as tahun')
            ->get()
            ->pluck('tahun', 'tahun');
        $usulans = Usulan::JENIS_USULAN;
        $no = 1;

        return view('admins.monitorings.proposals.dosen_index', compact(
            'tahun',
            'tahuns',
            'usulan',
            'usulans',
            'dosens',
            'no'
        ));
    }
}
