@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Tahapan' => route('admin.rip-tahapans.index'),
        'Detail' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('rip_tahapan_manage')
        {!! cui_toolbar_btn(route('admin.rip-tahapans.index'), 'icon-list', trans('global.list').' '.trans('cruds.ripTahapan.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.rip-tahapans.edit',[$ripTahapan->id]), 'icon-pencil', trans('global.edit').' '.trans('cruds.ripTahapan.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.rip-tahapans.destroy',[$ripTahapan->id]), 'icon-trash', trans('global.delete').' '.trans('cruds.ripTahapan.title_singular') ) !!}
    @endcan
@stop
@section('content')

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.show') }} {{ trans('cruds.ripTahapan.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ripTahapan.fields.id') }}
                        </th>
                        <td>
                            {{ $ripTahapan->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ripTahapan.fields.sub_topik') }}
                        </th>
                        <td>
                            {{ $ripTahapan->sub_topik->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ripTahapan.fields.tahun') }}
                        </th>
                        <td>
                            {{ $ripTahapan->tahun }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ripTahapan.fields.bahasan') }}
                        </th>
                        <td>
                            {!! $ripTahapan->bahasan !!}
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
            <a class="nav-link" href="#tahapan_penelitians" role="tab" data-toggle="tab">
                {{ trans('cruds.penelitian.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="tahapan_penelitians">
            @includeIf('admin.ripTahapans.relationships.tahapanPenelitians', ['penelitians' => $ripTahapan->tahapanPenelitians])
        </div>
    </div>
</div>

@endsection
