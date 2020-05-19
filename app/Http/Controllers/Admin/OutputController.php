<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOutputRequest;
use App\Http\Requests\StoreOutputRequest;
use App\Http\Requests\UpdateOutputRequest;
use App\JenisUsulan;
use App\Output;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OutputController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('output_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $outputs = Output::all();

        return view('admins.referensis.outputs.index', compact('outputs'));
    }

    public function create()
    {
        abort_if(Gate::denies('output_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jenis_usulans = JenisUsulan::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admins.referensis.outputs.create', compact('jenis_usulans'));
    }

    public function store(StoreOutputRequest $request)
    {
        $output = Output::create($request->all());

        if($output){
            notify('success', 'Berhasil menambahkan data output');
            return redirect()->route('admin.outputs.index');
        }
        notify('error', 'Terjadi kegagalan tambah data output');
        return redirect()->back();

    }

    public function edit(Output $output)
    {
        abort_if(Gate::denies('output_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jenis_usulans = JenisUsulan::all()->pluck('nama', 'id')->prepend(trans('global.pleaseSelect'), '');

        $output->load('jenis_usulan');

        return view('admins.referensis.outputs.edit', compact('jenis_usulans', 'output'));
    }

    public function update(UpdateOutputRequest $request, Output $output)
    {
        if ($output->update($request->all()))
        {
            notify('success', 'Berhasil mengubah data jenis output');
            return redirect()->route('admin.outputs.index');
        }
        notify('error', 'Gagal mengubah data jenis output');
        return redirect()->back();
    }

    public function show(Output $output)
    {
        abort_if(Gate::denies('output_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $output->load('jenis_usulan', 'outputOutputSkemas');

        return view('admins.referensis.outputs.show', compact('output'));
    }

    public function destroy(Output $output)
    {
        abort_if(Gate::denies('output_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if($output->delete()){
            notify('success', 'Berhasil menghapud data jenis output');
        }else{
            notify('error', 'Gagal menghapus data jenis output');
        }
        return back();
    }

}
