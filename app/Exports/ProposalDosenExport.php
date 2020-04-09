<?php

namespace App\Exports;

use App\Usulan;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class ProposalDosenExport implements FromView
{
    public function __construct($tahun, $jenis_usulan)
    {
        $this->tahun = $tahun;
        $this->usulan= $jenis_usulan;
    }

    /**
     * @inheritDoc
     */
    public function view(): View
    {

        $table = 'penelitians';
        if($this->usulan == Usulan::PENELITIAN){
            $table = 'penelitians';
        }else if($this->usulan == Usulan::PENGABDIAN){
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
            ->where($table.'.tahun', $this->tahun)
            ->whereNotNull($table.'.id')
            ->whereNull($table.'.deleted_at')
            ->where('usulan_anggota.tipe', 1)
            ->groupBy('dosens.id')
            ->get();

        $no = 1;

        return view('admins.monitorings.proposals.dosen_table', compact('dosens', 'no'));
    }
}
