@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Topik' => route('admin.rip-topiks.index'),
        'Detail' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('rip_topik_manage')
        {!! cui_toolbar_btn(route('admin.prodis.index'), 'icon-list', trans('global.list').' '.trans('cruds.ripTopik.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.prodis.edit',[$ripTopik->id]), 'icon-pencil', trans('global.edit').' '.trans('cruds.ripTopik.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.prodis.destroy',[$ripTopik->id]), 'icon-trash', trans('global.delete').' '.trans('cruds.ripTopik.title_singular') ) !!}
    @endcan
@stop
@section('content')

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.show') }} {{ trans('cruds.ripTopik.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ripTopik.fields.id') }}
                        </th>
                        <td>
                            {{ $ripTopik->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ripTopik.fields.subtema') }}
                        </th>
                        <td>
                            {{ $ripTopik->subtema->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ripTopik.fields.nama') }}
                        </th>
                        <td>
                            {{ $ripTopik->nama }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ripTopik.fields.luaran') }}
                        </th>
                        <td>
                            {!! $ripTopik->luaran !!}
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
            <a class="nav-link" href="#topik_rip_sub_topiks" role="tab" data-toggle="tab">
                {{ trans('cruds.ripSubTopik.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="topik_rip_sub_topiks">
            @includeIf('admin.ripTopiks.relationships.topikRipSubTopiks', ['ripSubTopiks' => $ripTopik->topikRipSubTopiks])
        </div>
    </div>
</div>

@endsection
