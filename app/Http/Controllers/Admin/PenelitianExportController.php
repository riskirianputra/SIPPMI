<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PenelitianExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PenelitianExportController extends Controller
{
    public function export()
    {
        return Excel::download(new PenelitianExport, 'penelitians.xlsx');
    }
}
