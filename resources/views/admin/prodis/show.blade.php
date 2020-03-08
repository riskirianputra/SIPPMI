@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Program Studi' => route('admin.prodis.index'),
        'Show' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('prodi_view')
        {!! cui_toolbar_btn(route('admin.prodis.index'), 'icon-list', trans('global.list').' '.trans('cruds.prodi.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.prodis.edit',[$prodi->id]), 'icon-pencil', trans('global.edit').' '.trans('cruds.prodi.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.prodis.destroy',[$prodi->id]), 'icon-trash', trans('global.delete').' '.trans('cruds.prodi.title_singular') ) !!}
        @endcan
@stop
@section('content')

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.show') }} {{ trans('cruds.prodi.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.prodi.fields.id') }}
                        </th>
                        <td>
                            {{ $prodi->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prodi.fields.nama') }}
                        </th>
                        <td>
                            {{ $prodi->nama }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prodi.fields.fakultas') }}
                        </th>
                        <td>
                            {{ $prodi->fakultas->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prodi.fields.kode') }}
                        </th>
                        <td>
                            {{ $prodi->kode }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prodi.fields.kode_dikti') }}
                        </th>
                        <td>
                            {{ $prodi->kode_dikti }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prodi.fields.akreditasi') }}
                        </th>
                        <td>
                            {{ $prodi->akreditasi }}
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
            <a class="nav-link" href="#prodi_penelitians" role="tab" data-toggle="tab">
                {{ trans('cruds.penelitian.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#prodi_pengabdians" role="tab" data-toggle="tab">
                {{ trans('cruds.pengabdian.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#prodi_dosens" role="tab" data-toggle="tab">
                {{ trans('cruds.dosen.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="prodi_penelitians">
            @includeIf('admin.prodis.relationships.prodiPenelitians', ['penelitians' => $prodi->prodiPenelitians])
        </div>
        <div class="tab-pane" role="tabpanel" id="prodi_pengabdians">
            @includeIf('admin.prodis.relationships.prodiPengabdians', ['pengabdians' => $prodi->prodiPengabdians])
        </div>
        <div class="tab-pane" role="tabpanel" id="prodi_dosens">
            @includeIf('admin.prodis.relationships.prodiDosens', ['dosens' => $prodi->prodiDosens])
        </div>
    </div>
</div>

@endsection
