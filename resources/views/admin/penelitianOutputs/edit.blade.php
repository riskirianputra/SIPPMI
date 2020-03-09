@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Output Penelitian' => route('admin.penelitian-outputs.index'),
        'Edit' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('penelitian_output_view')
        {!! cui_toolbar_btn(route('admin.penelitian-outputs.index'), 'icon-list', trans('global.list').' '.trans('cruds.penelitianOutput.title_singular') ) !!}
    @endcan
@stop
@section('content')
<div class="col">
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    {{ trans('global.edit') }} {{ trans('cruds.penelitianOutput.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("admin.penelitian-outputs.update", [$penelitianOutput->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="output_skema_id">{{ trans('cruds.penelitianOutput.fields.output_skema') }}</label>
                            <select class="form-control select2 {{ $errors->has('output_skema') ? 'is-invalid' : '' }}" name="output_skema_id" id="output_skema_id" required>
                                @foreach($output_skemas as $id => $output_skema)
                                    <option value="{{ $id }}" {{ ($penelitianOutput->output_skema ? $penelitianOutput->output_skema->id : old('output_skema_id')) == $id ? 'selected' : '' }}>{{ $output_skema }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('output_skema_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('output_skema_id') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.penelitianOutput.fields.output_skema_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="penelitian_id">{{ trans('cruds.penelitianOutput.fields.penelitian') }}</label>
                            <select class="form-control select2 {{ $errors->has('penelitian') ? 'is-invalid' : '' }}" name="penelitian_id" id="penelitian_id" required>
                                @foreach($penelitians as $id => $penelitian)
                                    <option value="{{ $id }}" {{ ($penelitianOutput->penelitian ? $penelitianOutput->penelitian->id : old('penelitian_id')) == $id ? 'selected' : '' }}>{{ $penelitian }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('penelitian_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('penelitian_id') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.penelitianOutput.fields.penelitian_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="filename">{{ trans('cruds.penelitianOutput.fields.filename') }}</label>
                            <input class="form-control {{ $errors->has('filename') ? 'is-invalid' : '' }}" type="text" name="filename" id="filename" value="{{ old('filename', $penelitianOutput->filename) }}" required>
                            @if($errors->has('filename'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('filename') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.penelitianOutput.fields.filename_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="tanggal_upload">{{ trans('cruds.penelitianOutput.fields.tanggal_upload') }}</label>
                            <input class="form-control date {{ $errors->has('tanggal_upload') ? 'is-invalid' : '' }}" type="text" name="tanggal_upload" id="tanggal_upload" value="{{ old('tanggal_upload', $penelitianOutput->tanggal_upload) }}" required>
                            @if($errors->has('tanggal_upload'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tanggal_upload') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.penelitianOutput.fields.tanggal_upload_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
