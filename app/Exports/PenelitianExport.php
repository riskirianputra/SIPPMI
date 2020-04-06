<?php

namespace App\Exports;

use App\Penelitian;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PenelitianExport implements FromView
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
        $penelitians = Penelitian::where('tahun', $this->tahun);
        if (!empty($this->skema)) {
            $penelitians = Penelitian::where('skema_id', $this->skema);
        }
        $penelitians = $penelitians->get();
        $no = 1;
        $ketua = null;

        return view('admins.penelitians.exports', compact('penelitians', 'ketua', 'no'));
    }
}
