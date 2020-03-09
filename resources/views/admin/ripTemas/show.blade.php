@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Tema' => route('admin.rip-temas.index'),
        'Detail' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('rip_tema_manage')
        {!! cui_toolbar_btn(route('admin.rip-temas.index'), 'icon-list', trans('global.list').' '.trans('cruds.ripTema.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.rip-temas.edit',[$ripTema->id]), 'icon-pencil', trans('global.edit').' '.trans('cruds.ripTema.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.rip-temas.destroy',[$ripTema->id]), 'icon-trash', trans('global.delete').' '.trans('cruds.ripTema.title_singular') ) !!}
    @endcan
@stop
@section('content')

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.show') }} {{ trans('cruds.ripTema.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ripTema.fields.periode') }}
                        </th>
                        <td>
                            {{ $ripTema->periode }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ripTema.fields.status') }}
                        </th>
                        <td>
                            {{ $ripTema->status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ripTema.fields.nama') }}
                        </th>
                        <td>
                            {{ $ripTema->nama }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ripTema.fields.luaran') }}
                        </th>
                        <td>
                            {!! $ripTema->luaran !!}
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
            <a class="nav-link" href="#tema_rip_sub_temas" role="tab" data-toggle="tab">
                {{ trans('cruds.ripSubTema.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="tema_rip_sub_temas">
            @includeIf('admin.ripTemas.relationships.temaRipSubTemas', ['ripSubTemas' => $ripTema->temaRipSubTemas])
        </div>
    </div>
</div>

@endsection
