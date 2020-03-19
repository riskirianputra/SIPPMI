@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Dosen' => route('admin.dosens.index'),
        'Detail' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('dosen_manage')
        {!! cui_toolbar_btn(route('admin.dosens.skemas.create', [$dosen->id]), 'cil-pencil', 'Skema Penelitian') !!}
        {!! cui_toolbar_btn(route('admin.dosens.create'), 'icon-plus', trans('global.add').' '.trans('cruds.dosen.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.dosens.edit',[$dosen->id]), 'icon-pencil', trans('global.edit').' '.trans('cruds.dosen.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.dosens.destroy',[$dosen->id]), 'icon-trash', trans('global.delete').' '.trans('cruds.dosen.title_singular') ) !!}
    @endcan
@stop
@section('content')

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.show') }} {{ trans('cruds.dosen.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.dosen.fields.id') }}
                        </th>
                        <td>
                            {{ $dosen->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dosen.fields.nama') }}
                        </th>
                        <td>
                            {{ $dosen->nama }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dosen.fields.nip') }}
                        </th>
                        <td>
                            {{ $dosen->nip }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dosen.fields.nidn') }}
                        </th>
                        <td>
                            {{ $dosen->nidn }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dosen.fields.email') }}
                        </th>
                        <td>
                            {{ $dosen->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dosen.fields.prodi') }}
                        </th>
                        <td>
                            {{ $dosen->prodi->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dosen.fields.tempat_lahir') }}
                        </th>
                        <td>
                            {{ $dosen->tempat_lahir }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dosen.fields.tanggal_lahir') }}
                        </th>
                        <td>
                            {{ $dosen->tanggal_lahir }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dosen.fields.jabatan_fungsional') }}
                        </th>
                        <td>
                            {{ App\Dosen::JABATAN_FUNGSIONAL_SELECT[$dosen->jabatan_fungsional] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dosen.fields.status') }}
                        </th>
                        <td>
                            {{ $dosen->status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dosen.fields.jenis_kelamin') }}
                        </th>
                        <td>
                            {{ App\Dosen::JENIS_KELAMIN_RADIO[$dosen->jenis_kelamin] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dosen.fields.pangkat_golongan') }}
                        </th>
                        <td>
                            {{ App\Dosen::PANGKAT_GOLONGAN_SELECT[$dosen->pangkat_golongan] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dosen.fields.telepon') }}
                        </th>
                        <td>
                            {{ $dosen->telepon }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

{{--<div class="card">--}}
{{--    <div class="card-header">--}}
{{--        {{ trans('global.relatedData') }}--}}
{{--    </div>--}}
{{--    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="#dosen_penelitian_anggota" role="tab" data-toggle="tab">--}}
{{--                {{ trans('cruds.penelitianAnggotum.title') }}--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="#dosen_pengabdian_anggota" role="tab" data-toggle="tab">--}}
{{--                {{ trans('cruds.pengabdianAnggotum.title') }}--}}
{{--            </a>--}}
{{--        </li>--}}
{{--    </ul>--}}
{{--    <div class="tab-content">--}}
{{--        <div class="tab-pane" role="tabpanel" id="dosen_penelitian_anggota">--}}
{{--            @includeIf('admin.dosens.relationships.dosenPenelitianAnggota', ['penelitianAnggota' => $dosen->dosenPenelitianAnggota])--}}
{{--        </div>--}}
{{--        <div class="tab-pane" role="tabpanel" id="dosen_pengabdian_anggota">--}}
{{--            @includeIf('admin.dosens.relationships.dosenPengabdianAnggota', ['pengabdianAnggota' => $dosen->dosenPengabdianAnggota])--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

@endsection
