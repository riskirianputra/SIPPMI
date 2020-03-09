@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Sub Tema' => route('admin.rip-sub-temas.index'),
        'Edit' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('rip_sub_tema_manage')
        {!! cui_toolbar_btn(route('admin.rip-sub-temas.index'), 'icon-list', trans('global.list').' '.trans('cruds.ripSubTema.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.rip-sub-temas.edit',[$ripSubTema->id]), 'icon-pencil', trans('global.edit').' '.trans('cruds.ripSubTema.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.rip-sub-temas.destroy',[$ripSubTema->id]), 'icon-trash', trans('global.delete').' '.trans('cruds.ripSubTema.title_singular') ) !!}
    @endcan
@stop
@section('content')

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.show') }} {{ trans('cruds.ripSubTema.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ripSubTema.fields.id') }}
                        </th>
                        <td>
                            {{ $ripSubTema->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ripSubTema.fields.tema') }}
                        </th>
                        <td>
                            {{ $ripSubTema->tema->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ripSubTema.fields.nama') }}
                        </th>
                        <td>
                            {{ $ripSubTema->nama }}
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
            <a class="nav-link" href="#subtema_rip_topiks" role="tab" data-toggle="tab">
                {{ trans('cruds.ripTopik.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="subtema_rip_topiks">
            @includeIf('admin.ripSubTemas.relationships.subtemaRipTopiks', ['ripTopiks' => $ripSubTema->subtemaRipTopiks])
        </div>
    </div>
</div>

@endsection
