@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Anggota Pengabdian' => route('admin.pengabdian-anggota.index'),
        'Create' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('pengabdian_anggotum_manage')
        {!! cui_toolbar_btn(route('admin.pengabdian-anggota.index'), 'icon-list', trans('global.list').' '.trans('cruds.pengabdianAnggotum.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.pengabdian-anggota.edit',[$pengabdianAnggotum->id]), 'icon-pencil', trans('global.edit').' '.trans('cruds.pengabdianAnggotum.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.pengabdian-anggota.destroy',[$pengabdianAnggotum->id]), 'icon-trash', trans('global.delete').' '.trans('cruds.pengabdianAnggotum.title_singular') ) !!}
    @endcan
@stop
@section('content')
<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.show') }} {{ trans('cruds.pengabdianAnggotum.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdianAnggotum.fields.id') }}
                        </th>
                        <td>
                            {{ $pengabdianAnggotum->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdianAnggotum.fields.pengabdian') }}
                        </th>
                        <td>
                            {{ $pengabdianAnggotum->pengabdian->judul ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdianAnggotum.fields.dosen') }}
                        </th>
                        <td>
                            {{ $pengabdianAnggotum->dosen->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdianAnggotum.fields.jabatan') }}
                        </th>
                        <td>
                            {{ App\PengabdianAnggotum::JABATAN_SELECT[$pengabdianAnggotum->jabatan] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
