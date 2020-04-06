<?php

namespace App\Exports;

use App\Pengabdian;
use Maatwebsite\Excel\Concerns\FromView;

class PengabdianExport implements FromView
{
    public function __construct($skema = null, $tahun = null)
    {
        $this->skema = $skema;
        if (empty($this->tahun)) {
            $this->tahun = $tahun;
        } else {
            $this->tahun = date('Y');
        }
    }

    public function view(): \Illuminate\Contracts\View\View
    {
        $pengabdians = Pengabdian::where('tahun', $this->tahun);
        if (!empty($this->skema)) {
            $pengabdians = Pengabdian::where('skema_id', $this->skema);
        }
        $pengabdians = $pengabdians->get();
        $no = 1;
        $ketua = null;

        return view('admins.pengabdians.exports', compact('pengabdians', 'ketua', 'no'));
    }
}
