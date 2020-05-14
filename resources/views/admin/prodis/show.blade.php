@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Program Studi' => route('admin.prodis.index'),
        'Lihat' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('kode_rumpun_manage')
        {!! cui()->toolbar_delete(route('admin.kode-rumpuns.destroy', $prodi->id), $prodi->id, 'cil-trash', 'Hapus', 'Anda yakin akan menghapus data ini?') !!}
        {!! cui()->toolbar_btn(route('admin.prodis.edit', $prodi->id), 'cil-pencil', 'Edit') !!}
        {!! cui()->toolbar_btn(route('admin.prodis.create'), 'cil-plus', 'Tambah') !!}
    @endcan
    @can('prodi_view')
        {!! cui()->toolbar_btn(route('admin.prodis.index'), 'cil-list', 'List Program Studi') !!}
    @endcan
@stop
@section('content')

<div class="card">
    <div class="card-header font-weight-bold">
        <i class="cil-zoom"></i> Lihat Program Studi
    </div>

    <div class="card-body">
        <div class="form-group row">
            <div class="col-sm-2">
                <strong>{{ trans('cruds.prodi.fields.id') }}</strong>
            </div>
            <div class="col-sm-10">
            {{ $prodi->id }}
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-2">
                <strong>{{ trans('cruds.prodi.fields.nama') }}</strong>
            </div>
            <div class="col-sm-10">
            {{ $prodi->nama }}
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-2">
                <strong>{{ trans('cruds.prodi.fields.fakultas') }}</strong>
            </div>
            <div class="col-sm-10">
            {{ $prodi->fakultas->nama ?? '' }}
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-2">
                <strong>{{ trans('cruds.prodi.fields.kode') }}</strong>
            </div>
            <div class="col-sm-10">
            {{ $prodi->kode }}
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-2">
                <strong>{{ trans('cruds.prodi.fields.kode_dikti') }}</strong>
            </div>
            <div class="col-sm-10">
            {{ $prodi->kode_dikti }}
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-2">
                <strong>{{ trans('cruds.prodi.fields.akreditasi') }}</strong>
            </div>
            <div class="col-sm-10">
            {{ $prodi->akreditasi }}
            </div>
        </div>
    </div>
</div>


@endsection
