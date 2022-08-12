<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Pemakalah;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class PemakalahController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('kinerja_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pemakalahs = Pemakalah::all();

        $levels = Pemakalah::LEVELS;
        $tahuns = [];
        for ($i = date("Y"); $i >= 2018; $i--)
            $tahuns[$i] = $i;

        return view('admins.kinerjas.pemakalahs.index', compact(
            'pemakalahs',
            'tahuns',
            'levels'
        ));
    }

    public function filter(Request $request)
    {
        abort_if(Gate::denies('kinerja_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tahun = $request->get('tahun');
        $level = $request->get('tingkat');

        $query = Pemakalah::whereNotNull('id');

        if(!empty($tahun)){
            $query = Pemakalah::where('tahun', $tahun);
        }

        if(!empty($level)){
            $query->where('tingkat', $level);
        }

        $pemakalahs = $query->get();

        $levels = Pemakalah::LEVELS;
        $tahuns = [];
        for ($i = date("Y"); $i >= 2018; $i--)
            $tahuns[$i] = $i;

        return view('admins.kinerjas.pemakalahs.index', compact('pemakalahs', 'tahuns', 'levels'));
    }

    public function show(Pemakalah $pemakalah)
    {
        abort_if(Gate::denies('kinerja_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admins.kinerjas.pemakalahs.show', compact('pemakalah'));
    }
}
