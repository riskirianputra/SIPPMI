@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Skema' => route('admin.ref-skemas.index'),
        'Detail Skema' => route('admin.ref-skemas.index',[$refSkema_id]),
        'Detail Output Skema' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('output_skema_manage')
        {!! cui_toolbar_btn(route('admin.ref-skemas.show',[$refSkema_id]), 'icon-eye', trans('global.show').' '.trans('cruds.refSkema.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.output-skemas.edit',[$refSkema_id,$outputSkema]), 'icon-pencil', trans('global.edit').' '.trans('cruds.outputSkema.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.output-skemas.destroy',[$refSkema_id,$outputSkema]), 'icon-trash', trans('global.delete').' '.trans('cruds.outputSkema.title_singular') ) !!}
    @endcan
@stop
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.outputSkema.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.outputSkema.fields.output') }}
                        </th>
                        <td>
                            {{ $outputSkema->output->luaran ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.outputSkema.fields.skema') }}
                        </th>
                        <td>
                            {{ $outputSkema->skema->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.outputSkema.fields.field') }}
                        </th>
                        <td>
                            {{ $outputSkema->field }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.outputSkema.fields.mime') }}
                        </th>
                        <td>
                            {{ $outputSkema->mime }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.outputSkema.fields.required') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $outputSkema->required ? 'checked' : '' }}>
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
            <a class="nav-link" href="#output_skema_penelitian_outputs" role="tab" data-toggle="tab">
                {{ trans('cruds.penelitianOutput.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#output_skema_pengabdian_outputs" role="tab" data-toggle="tab">
                {{ trans('cruds.pengabdianOutput.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="output_skema_penelitian_outputs">
            @includeIf('admin.outputSkemas.relationships.outputSkemaPenelitianOutputs', ['penelitianOutputs' => $outputSkema->outputSkemaPenelitianOutputs])
        </div>
        <div class="tab-pane" role="tabpanel" id="output_skema_pengabdian_outputs">
            @includeIf('admin.outputSkemas.relationships.outputSkemaPengabdianOutputs', ['pengabdianOutputs' => $outputSkema->outputSkemaPengabdianOutputs])
        </div>
    </div>
</div>

@endsection
