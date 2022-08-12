<?php

namespace App\Http\Controllers\Admin;

use App\Exports\MonitoringReviewExport;
use App\Exports\PenelitianExport;
use App\Http\Controllers\Controller;
use App\Penelitian;
use App\Pengabdian;
use App\RefSkema;
use App\TahapanReview;
use App\Usulan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MonitoringReviewController extends Controller
{
    public function progress()
    {
        $tahuns = Penelitian::selectRaw('distinct(tahun) as tahun')
            ->get()
            ->pluck('tahun', 'tahun');
        $tahapans = TahapanReview::all()->pluck('nama', 'id');
        $skemas = RefSkema::all()->pluck('nama', 'id');
        $usulans = collect([]);

        return view('admins.monitorings.reviews.progress', compact(
            'tahuns',
            'tahapans',
            'skemas',
            'usulans'
        ));
    }

    public function post_progress(Request $request)
    {
        $request->validate([
            'tahun' => 'required',
            'skema' => 'required',
            'tahapan' => 'required',
        ]);

        $tahuns = Penelitian::selectRaw('distinct(tahun) as tahun')
            ->get()
            ->pluck('tahun', 'tahun');
        $tahapans = TahapanReview::all()->pluck('nama', 'id');
        $skemas = RefSkema::all()->pluck('nama', 'id');

        $tahun = $request->tahun;
        $skema = $request->skema;
        $tahapan = $request->tahapan;

        $tahapan_review = TahapanReview::find($tahapan);
        $jumlah_reviewers = $tahapan_review->jumlah_reviewer;

        if ($request->has('export')) {
            $skema_name = RefSkema::findOrFail($skema)->nama;
            $tahapan_name = $tahapan_review->nama;
            $filename = 'review-'.$tahapan_name.'-' . $skema_name . '-' . $tahun . '.xlsx';

            return Excel::download(new MonitoringReviewExport($tahun, $skema, $tahapan), $filename);
        }

        $jenis_usulan = RefSkema::find($skema)->jenis_usulan;
        if ($jenis_usulan == Usulan::PENELITIAN) {
            $usulans = Penelitian::where('skema_id', $skema)
                ->where('tahun', $tahun)
                ->get();
        } else if ($jenis_usulan == Usulan::PENGABDIAN) {
            $usulans = Pengabdian::where('skema_id', $skema)
                ->where('tahun', $tahun)
                ->get();
        }
        $no = 1;

        return view('admins.monitorings.reviews.progress', compact(
            'tahuns',
            'tahapans',
            'skemas',
            'tahun',
            'tahapan',
            'skema',
            'usulans',
            'jumlah_reviewers',
            'no'
        ));
    }
}
