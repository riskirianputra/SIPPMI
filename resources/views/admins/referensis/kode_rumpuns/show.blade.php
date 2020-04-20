@extends('layouts.admin')

@section('breadcrumb')
    {!! cui()->breadcrumb([
        'Home' => url('home'),
        'Kode Rumpun Ilmu' => route('admin.kode-rumpuns.index'),
        'Lihat' => '#'
    ]) !!}
@endsection

@section('toolbar')
    @can('kode_rumpun_manage')
        {!! cui()->toolbar_delete(route('admin.kode-rumpuns.destroy', $kodeRumpun->id), $kodeRumpun->id, 'cil-trash', 'Hapus', 'Anda yakin akan menghapus data ini?') !!}
        {!! cui()->toolbar_btn(route('admin.kode-rumpuns.edit', $kodeRumpun->id), 'cil-pencil', 'Edit') !!}
        {!! cui()->toolbar_btn(route('admin.kode-rumpuns.create'), 'cil-plus', 'Tambah') !!}
    @endcan
    @can('kode_rumpun_view')
        {!! cui()->toolbar_btn(route('admin.kode-rumpuns.index'), 'cil-list', 'List Rumpun Ilmu') !!}
    @endcan
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <strong><i class="cil-zoom"></i> Lihat Kode Rumpun</strong>
        </div>

        <div class="card-body">

            <div class="form-group row">
                <div class="col-sm-2">
                    <strong>Kode</strong>
                </div>
                <div class="col-sm-10">
                    {{ $kodeRumpun->kode }}
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-2">
                    <strong>Rumpun Ilmu</strong>
                </div>
                <div class="col-sm-10">
                    {{ $kodeRumpun->rumpun_ilmu }}
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-2">
                    <strong>Level</strong>
                </div>
                <div class="col-sm-10">
                    {{ $kodeRumpun->level }}
                </div>
            </div>
        </div>
    </div>

@endsection
