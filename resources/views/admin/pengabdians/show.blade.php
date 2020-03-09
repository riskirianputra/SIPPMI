@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Pengabdian' => route('admin.pengabdians.index'),
        'Detail' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('pengabdian_manage')
        {!! cui_toolbar_btn(route('admin.pengabdians.index'), 'icon-list', trans('global.list').' '.trans('cruds.pengabdian.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.pengabdians.edit',[$pengabdian->id]), 'icon-pencil', trans('global.edit').' '.trans('cruds.pengabdian.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.pengabdians.destroy',[$pengabdian->id]), 'icon-trash', trans('global.delete').' '.trans('cruds.pengabdian.title_singular') ) !!}
    @endcan
@stop
@section('content')

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.show') }} {{ trans('cruds.pengabdian.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">

            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdian.fields.id') }}
                        </th>
                        <td>
                            {{ $pengabdian->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdian.fields.judul') }}
                        </th>
                        <td>
                            {{ $pengabdian->judul }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdian.fields.mitra_pengabdian') }}
                        </th>
                        <td>
                            {{ $pengabdian->mitra_pengabdian }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdian.fields.skema') }}
                        </th>
                        <td>
                            {{ $pengabdian->skema->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdian.fields.prodi') }}
                        </th>
                        <td>
                            {{ $pengabdian->prodi->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdian.fields.kode_rumpun') }}
                        </th>
                        <td>
                            {{ $pengabdian->kode_rumpun->rumpun_ilmu ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdian.fields.ringkasan_eksekutif') }}
                        </th>
                        <td>
                            {{ $pengabdian->ringkasan_eksekutif }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdian.fields.status_pengabdian') }}
                        </th>
                        <td>
                            {{ $pengabdian->status_pengabdian }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdian.fields.multi_tahun') }}
                        </th>
                        <td>
                            {{ App\Pengabdian::MULTI_TAHUN_SELECT[$pengabdian->multi_tahun] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdian.fields.tahun_ke') }}
                        </th>
                        <td>
                            {{ $pengabdian->tahun_ke }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdian.fields.biaya') }}
                        </th>
                        <td>
                            {{ $pengabdian->biaya }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdian.fields.file_proposal') }}
                        </th>
                        <td>
                            @if($pengabdian->file_proposal)
                                <a href="{{ $pengabdian->file_proposal->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdian.fields.file_lembaran_pengesahan') }}
                        </th>
                        <td>
                            @if($pengabdian->file_lembaran_pengesahan)
                                <a href="{{ $pengabdian->file_lembaran_pengesahan->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdian.fields.file_laporan_kemajuan') }}
                        </th>
                        <td>
                            @if($pengabdian->file_laporan_kemajuan)
                                <a href="{{ $pengabdian->file_laporan_kemajuan->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdian.fields.file_laporan_keuangan') }}
                        </th>
                        <td>
                            @if($pengabdian->file_laporan_keuangan)
                                <a href="{{ $pengabdian->file_laporan_keuangan->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdian.fields.file_laporan_akhir') }}
                        </th>
                        <td>
                            @if($pengabdian->file_laporan_akhir)
                                <a href="{{ $pengabdian->file_laporan_akhir->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdian.fields.file_logbook') }}
                        </th>
                        <td>
                            @if($pengabdian->file_logbook)
                                <a href="{{ $pengabdian->file_logbook->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdian.fields.file_profile_pengabdian') }}
                        </th>
                        <td>
                            @if($pengabdian->file_profile_pengabdian)
                                <a href="{{ $pengabdian->file_profile_pengabdian->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#pengabdian_pengabdian_anggota" role="tab" data-toggle="tab">
                {{ trans('cruds.pengabdianAnggotum.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#pengabdian_pengabdian_outputs" role="tab" data-toggle="tab">
                {{ trans('cruds.pengabdianOutput.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#pengabdian_pengabdian_biayas" role="tab" data-toggle="tab">
                {{ trans('cruds.pengabdianBiaya.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="pengabdian_pengabdian_anggota">
            @includeIf('admin.pengabdians.relationships.pengabdianPengabdianAnggota', ['pengabdianAnggota' => $pengabdian->pengabdianPengabdianAnggota])
        </div>
        <div class="tab-pane" role="tabpanel" id="pengabdian_pengabdian_outputs">
            @includeIf('admin.pengabdians.relationships.pengabdianPengabdianOutputs', ['pengabdianOutputs' => $pengabdian->pengabdianPengabdianOutputs])
        </div>
        <div class="tab-pane" role="tabpanel" id="pengabdian_pengabdian_biayas">
            @includeIf('admin.pengabdians.relationships.pengabdianPengabdianBiayas', ['pengabdianBiayas' => $pengabdian->pengabdianPengabdianBiayas])
        </div>
    </div>
</div>

@endsection
