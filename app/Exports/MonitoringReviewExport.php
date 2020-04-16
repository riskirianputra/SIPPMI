<?php

namespace App\Exports;

use App\Penelitian;
use App\Pengabdian;
use App\RefSkema;
use App\TahapanReview;
use App\Usulan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MonitoringReviewExport implements FromView
{

    public $tahun;
    public $skema;
    public $tahapan;

    public function __construct($tahun, $skema, $tahapan)
    {
        $this->tahun = $tahun;
        $this->skema = $skema;
        $this->tahapan = $tahapan;
    }

    public function view(): View
    {
        $usulans = collect([]);
        $tahapan_review = TahapanReview::find($this->tahapan);
        $jumlah_reviewers = $tahapan_review->jumlah_reviewer;
        $jenis_usulan = RefSkema::find($this->skema)->jenis_usulan;
        if ($jenis_usulan == Usulan::PENELITIAN) {
            $usulans = Penelitian::where('skema_id', $this->skema)
                ->where('tahun', $this->tahun)
                ->get();
        } else if ($jenis_usulan == Usulan::PENGABDIAN) {
            $usulans = Pengabdian::where('skema_id', $this->skema)
                ->where('tahun', $this->tahun)
                ->get();
        }
        $no = 1;

        return view('admins.monitorings.reviews.progress_table', compact(
            'usulans',
            'jumlah_reviewers',
            'no'
        ));
    }
}
