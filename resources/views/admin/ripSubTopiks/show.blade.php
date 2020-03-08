@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Sub Topik' => route('admin.rip-sub-topiks.index'),
        'Detail' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('rip_sub_topik_manage')
        {!! cui_toolbar_btn(route('admin.rip-sub-topiks.index'), 'icon-list', trans('global.list').' '.trans('cruds.ripSubTopik.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.rip-sub-topiks.edit',[$ripSubTopik->id]), 'icon-pencil', trans('global.edit').' '.trans('cruds.ripSubTopik.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.rip-sub-topiks.destroy',[$ripSubTopik->id]), 'icon-trash', trans('global.delete').' '.trans('cruds.ripSubTopik.title_singular') ) !!}
    @endcan
@stop
@section('content')

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.show') }} {{ trans('cruds.ripSubTopik.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ripSubTopik.fields.id') }}
                        </th>
                        <td>
                            {{ $ripSubTopik->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ripSubTopik.fields.topik') }}
                        </th>
                        <td>
                            {{ $ripSubTopik->topik->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ripSubTopik.fields.nama') }}
                        </th>
                        <td>
                            {{ $ripSubTopik->nama }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ripSubTopik.fields.luaran') }}
                        </th>
                        <td>
                            {{ $ripSubTopik->luaran }}
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
            <a class="nav-link" href="#sub_topik_rip_tahapans" role="tab" data-toggle="tab">
                {{ trans('cruds.ripTahapan.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="sub_topik_rip_tahapans">
            @includeIf('admin.ripSubTopiks.relationships.subTopikRipTahapans', ['ripTahapans' => $ripSubTopik->subTopikRipTahapans])
        </div>
    </div>
</div>

@endsection
