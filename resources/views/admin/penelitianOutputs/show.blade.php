@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Output Penelitian' => route('admin.penelitian-outputs.index'),
        'Detail' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('penelitian_output_manage')
        {!! cui_toolbar_btn(route('admin.penelitian-outputs.index'), 'icon-list', trans('global.list').' '.trans('cruds.penelitianOutput.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.penelitian-outputs.edit',[$penelitianOutput->id]), 'icon-pencil', trans('global.edit').' '.trans('cruds.penelitianOutput.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.penelitian-outputs.destroy',[$penelitianOutput->id]), 'icon-trash', trans('global.delete').' '.trans('cruds.penelitianOutput.title_singular') ) !!}
    @endcan
@stop
@section('content')

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.show') }} {{ trans('cruds.penelitianOutput.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.penelitianOutput.fields.id') }}
                        </th>
                        <td>
                            {{ $penelitianOutput->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.penelitianOutput.fields.output_skema') }}
                        </th>
                        <td>
                            {{ $penelitianOutput->output_skema->field ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.penelitianOutput.fields.penelitian') }}
                        </th>
                        <td>
                            {{ $penelitianOutput->penelitian->judul ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.penelitianOutput.fields.filename') }}
                        </th>
                        <td>
                            {{ $penelitianOutput->filename }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.penelitianOutput.fields.tanggal_upload') }}
                        </th>
                        <td>
                            {{ $penelitianOutput->tanggal_upload }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
