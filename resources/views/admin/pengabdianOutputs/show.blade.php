@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Output Pengabdian' => route('admin.pengabdian-outputs.index'),
        'Detail' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('pengabdian_output_manage')
        {!! cui_toolbar_btn(route('admin.pengabdian-outputs.index'), 'icon-list', trans('global.list').' '.trans('cruds.pengabdianOutput.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.pengabdian-outputs.edit',[$pengabdianOutput->id]), 'icon-pencil', trans('global.edit').' '.trans('cruds.pengabdianOutput.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.pengabdian-outputs.destroy',[$pengabdianOutput->id]), 'icon-trash', trans('global.delete').' '.trans('cruds.pengabdianOutput.title_singular') ) !!}
    @endcan
@stop
@section('content')

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.show') }} {{ trans('cruds.pengabdianOutput.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdianOutput.fields.id') }}
                        </th>
                        <td>
                            {{ $pengabdianOutput->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdianOutput.fields.output_skema') }}
                        </th>
                        <td>
                            {{ $pengabdianOutput->output_skema->field ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdianOutput.fields.pengabdian') }}
                        </th>
                        <td>
                            {{ $pengabdianOutput->pengabdian->judul ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdianOutput.fields.filename') }}
                        </th>
                        <td>
                            {{ $pengabdianOutput->filename }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pengabdianOutput.fields.tanggal_upload') }}
                        </th>
                        <td>
                            {{ $pengabdianOutput->tanggal_upload }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
