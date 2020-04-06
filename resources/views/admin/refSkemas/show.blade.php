@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Skema' => route('admin.ref-skemas.index'),
        'Detail' => '#'
    ]) !!}
@endsection

@section('toolbar')
    @can('ref_skema_manage')
        {!! cui_toolbar_btn(route('admin.ref-skemas.index'), 'cil-list', trans('global.list').' '.trans('cruds.refSkema.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.ref-skemas.edit',[$refSkema]), 'cil-pencil', trans('global.edit').' '.trans('cruds.refSkema.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.ref-skemas.destroy',[$refSkema]), 'cil-trash', trans('global.delete').' '.trans('cruds.refSkema.title_singular') ) !!}
    @endcan
@endsection

@section('content')
<div class="col">
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header font-weight-bold">
                    {{ trans('global.show') }} {{ trans('cruds.refSkema.title') }}
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <table class="table table-bordered table-striped">
                            <tbody>
                            <tr>
                                <th>
                                    {{ trans('cruds.refSkema.fields.jenis_usulan') }}
                                </th>
                                <td>
                                    {{ App\RefSkema::JENIS_USULAN_SELECT[$refSkema->jenis_usulan] ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.refSkema.fields.nama') }}
                                </th>
                                <td>
                                    {{ $refSkema->nama }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.refSkema.fields.jangka_waktu') }}
                                </th>
                                <td>
                                    {{ $refSkema->jangka_waktu }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.refSkema.fields.biaya_minimal') }}
                                </th>
                                <td>
                                    {{ $refSkema->biaya_minimal }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.refSkema.fields.biaya_maksimal') }}
                                </th>
                                <td>
                                    {{ $refSkema->biaya_maksimal }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.refSkema.fields.sumber_dana') }}
                                </th>
                                <td>
                                    {{ $refSkema->sumber_dana }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.refSkema.fields.anggota_min') }}
                                </th>
                                <td>
                                    {{ $refSkema->anggota_min }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.refSkema.fields.anggota_max') }}
                                </th>
                                <td>
                                    {{ $refSkema->anggota_max }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Mahasiswa Min
                                </th>
                                <td>
                                    {{ $refSkema->mahasiswa_min }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Mahasiswa Max
                                </th>
                                <td>
                                    {{ $refSkema->mahasiswa_max }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.refSkema.fields.tanggal_mulai') }}
                                </th>
                                <td>
                                    {{ $refSkema->tanggal_mulai }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.refSkema.fields.tanggal_selesai') }}
                                </th>
                                <td>
                                    {{ $refSkema->tanggal_selesai }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



        </div>
        <div class="col-sm-6">
            @includeIf('admin.refSkemas.relationships.skemaOutputSkemas', ['outputSkemas' => $refSkema->skemaOutputSkemas,'refSkema_id' => $refSkema->id])

            @include('admins.ref_skemas.questions._index', ['questions' => $refSkema->questions, 'skema' => $refSkema])
        </div>
    </div>
</div>

@endsection
