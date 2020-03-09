@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Biaya Pengabdian' => route('admin.pengabdian-biayas.index'),
        'Detail' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('pengabdian_biaya_manage')
        {!! cui_toolbar_btn(route('admin.pengabdian-biayas.index'), 'icon-list', trans('global.list').' '.trans('cruds.pengabdianBiaya.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.pengabdian-biayas.edit',[$pengabdianBiaya->id]), 'icon-pencil', trans('global.edit').' '.trans('cruds.pengabdianBiaya.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.pengabdian-biayas.destroy',[$pengabdianBiaya->id]), 'icon-trash', trans('global.delete').' '.trans('cruds.pengabdianBiaya.title_singular') ) !!}
    @endcan
@stop
@section('content')

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.show') }} {{ trans('cruds.pengabdianBiaya.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdianBiaya.fields.id') }}
                        </th>
                        <td>
                            {{ $pengabdianBiaya->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdianBiaya.fields.biaya_skema') }}
                        </th>
                        <td>
                            {{ $pengabdianBiaya->biaya_skema->persen_max ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdianBiaya.fields.pengabdian') }}
                        </th>
                        <td>
                            {{ $pengabdianBiaya->pengabdian->judul ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdianBiaya.fields.jumlah') }}
                        </th>
                        <td>
                            {{ $pengabdianBiaya->jumlah }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdianBiaya.fields.jumlah_final') }}
                        </th>
                        <td>
                            {{ $pengabdianBiaya->jumlah_final }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdianBiaya.fields.satuan') }}
                        </th>
                        <td>
                            {{ $pengabdianBiaya->satuan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdianBiaya.fields.harga_satuan') }}
                        </th>
                        <td>
                            {{ $pengabdianBiaya->harga_satuan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdianBiaya.fields.harga_satuan_final') }}
                        </th>
                        <td>
                            {{ $pengabdianBiaya->harga_satuan_final }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdianBiaya.fields.justifikasi') }}
                        </th>
                        <td>
                            {{ $pengabdianBiaya->justifikasi }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdianBiaya.fields.status') }}
                        </th>
                        <td>
                            {{ $pengabdianBiaya->status }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
