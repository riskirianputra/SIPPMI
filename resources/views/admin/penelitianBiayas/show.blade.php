@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Biaya Penelitian' => route('admin.penelitian-biayas.index'),
        'Detail' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('penelitian_biaya_manage')
        {!! cui_toolbar_btn(route('admin.penelitian-biayas.index'), 'icon-list', trans('global.list').' '.trans('cruds.penelitianBiaya.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.penelitian-biayas.edit',[$penelitianBiaya->id]), 'icon-pencil', trans('global.edit').' '.trans('cruds.penelitianBiaya.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.penelitian-biayas.destroy',[$penelitianBiaya->id]), 'icon-trash', trans('global.delete').' '.trans('cruds.penelitianBiaya.title_singular') ) !!}
    @endcan
@stop
@section('content')

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.show') }} {{ trans('cruds.penelitianBiaya.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.penelitianBiaya.fields.id') }}
                        </th>
                        <td>
                            {{ $penelitianBiaya->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.penelitianBiaya.fields.biaya_skema') }}
                        </th>
                        <td>
                            {{ $penelitianBiaya->biaya_skema->persen_max ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.penelitianBiaya.fields.penelitian') }}
                        </th>
                        <td>
                            {{ $penelitianBiaya->penelitian->judul ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.penelitianBiaya.fields.jumlah') }}
                        </th>
                        <td>
                            {{ $penelitianBiaya->jumlah }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.penelitianBiaya.fields.jumlah_final') }}
                        </th>
                        <td>
                            {{ $penelitianBiaya->jumlah_final }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.penelitianBiaya.fields.satuan') }}
                        </th>
                        <td>
                            {{ $penelitianBiaya->satuan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.penelitianBiaya.fields.harga_satuan') }}
                        </th>
                        <td>
                            {{ $penelitianBiaya->harga_satuan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.penelitianBiaya.fields.harga_satuan_final') }}
                        </th>
                        <td>
                            {{ $penelitianBiaya->harga_satuan_final }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.penelitianBiaya.fields.justifikasi') }}
                        </th>
                        <td>
                            {{ $penelitianBiaya->justifikasi }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.penelitianBiaya.fields.status') }}
                        </th>
                        <td>
                            {{ $penelitianBiaya->status }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
