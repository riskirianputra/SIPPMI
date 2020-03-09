@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Skema' => route('admin.ref-skemas.index'),
        'Output' => route('admin.outputs.index'),
        'Create' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('output_manage')
        {!! cui_toolbar_btn(route('admin.outputs.index'), 'icon-list', trans('global.list').' '.trans('cruds.output.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.outputs.edit',[$output->id]), 'icon-pencil', trans('global.edit').' '.trans('cruds.output.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.outputs.destroy',[$output->id]), 'icon-trash', trans('global.delete').' '.trans('cruds.output.title_singular') ) !!}
    @endcan
@stop
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.output.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.output.fields.id') }}
                        </th>
                        <td>
                            {{ $output->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.output.fields.code') }}
                        </th>
                        <td>
                            {{ $output->code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.output.fields.jenis_usulan') }}
                        </th>
                        <td>
                            {{ $output->jenis_usulan->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.output.fields.luaran') }}
                        </th>
                        <td>
                            {{ $output->luaran }}
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
            <a class="nav-link" href="#output_output_skemas" role="tab" data-toggle="tab">
                {{ trans('cruds.outputSkema.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="output_output_skemas">
            @includeIf('admin.outputs.relationships.outputOutputSkemas', ['outputSkemas' => $output->outputOutputSkemas])
        </div>
    </div>
</div>

@endsection
