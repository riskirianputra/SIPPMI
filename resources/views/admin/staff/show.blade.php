@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Staff' => route('admin.staff.index'),
        'Detail' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('staff_manage')
        {!! cui_toolbar_btn(route('admin.staff.index'), 'icon-list', trans('global.list').' '.trans('cruds.staff.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.staff.edit',[$staff->id]), 'icon-pencil', trans('global.edit').' '.trans('cruds.staff.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.staff.destroy',[$staff->id]), 'icon-trash', trans('global.delete').' '.trans('cruds.staff.title_singular') ) !!}
    @endcan
@stop
@section('content')

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.show') }} {{ trans('cruds.staff.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.staff.fields.id') }}
                        </th>
                        <td>
                            {{ $staff->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staff.fields.nama') }}
                        </th>
                        <td>
                            {{ $staff->nama }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staff.fields.nip') }}
                        </th>
                        <td>
                            {{ $staff->nip }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staff.fields.email') }}
                        </th>
                        <td>
                            {{ $staff->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staff.fields.tempat_lahir') }}
                        </th>
                        <td>
                            {{ $staff->tempat_lahir }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staff.fields.tanggal_lahir') }}
                        </th>
                        <td>
                            {{ $staff->tanggal_lahir }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staff.fields.status') }}
                        </th>
                        <td>
                            {{ $staff->status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staff.fields.jenis_kelamin') }}
                        </th>
                        <td>
                            {{ App\Staff::JENIS_KELAMIN_RADIO[$staff->jenis_kelamin] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.staff.fields.telepon') }}
                        </th>
                        <td>
                            {{ $staff->telepon }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
