@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Anggota Penelitian' => route('admin.penelitian-anggota.index'),
        'Create' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('penelitian_anggotum_manage')
        {!! cui_toolbar_btn(route('admin.penelitian-anggota.index'), 'icon-list', trans('global.list').' '.trans('cruds.penelitianAnggotum.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.penelitian-anggota.edit',[$penelitianAnggotum->id]), 'icon-pencil', trans('global.edit').' '.trans('cruds.penelitianAnggotum.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.penelitian-anggota.destroy',[$penelitianAnggotum->id]), 'icon-trash', trans('global.delete').' '.trans('cruds.penelitianAnggotum.title_singular') ) !!}
    @endcan
@stop
@section('content')

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.show') }} {{ trans('cruds.penelitianAnggotum.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.penelitianAnggotum.fields.id') }}
                        </th>
                        <td>
                            {{ $penelitianAnggotum->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.penelitianAnggotum.fields.dosen') }}
                        </th>
                        <td>
                            {{ $penelitianAnggotum->dosen->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.penelitianAnggotum.fields.penelitian') }}
                        </th>
                        <td>
                            {{ $penelitianAnggotum->penelitian->judul ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.penelitianAnggotum.fields.jabatan') }}
                        </th>
                        <td>
                            {{ App\PenelitianAnggotum::JABATAN_SELECT[$penelitianAnggotum->jabatan] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
