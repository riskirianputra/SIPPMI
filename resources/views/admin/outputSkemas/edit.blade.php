@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Skema' => route('admin.ref-skemas.index'),
        'Detail Skema' => route('admin.ref-skemas.index',[$refSkema_id]),
        'Add Output Skema' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('ref_skema_view')
        {!! cui_toolbar_btn(route('admin.ref-skemas.show',[$refSkema_id]), 'icon-eye', trans('global.show').' '.trans('cruds.refSkema.title_singular') ) !!}
    @endcan
@stop
@section('content')
<div class="col">
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    {{ trans('global.edit') }} {{ trans('cruds.outputSkema.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("admin.output-skemas.update", [$refSkema_id,$outputSkema->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="output_id">{{ trans('cruds.outputSkema.fields.output') }}</label>
                            <select class="form-control select2 {{ $errors->has('output') ? 'is-invalid' : '' }}" name="output_id" id="output_id" required>
                                @foreach($outputs as $id => $output)
                                    <option value="{{ $id }}" {{ ($outputSkema->output ? $outputSkema->output->id : old('output_id')) == $id ? 'selected' : '' }}>{{ $output }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('output_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('output_id') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.outputSkema.fields.output_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="field">{{ trans('cruds.outputSkema.fields.field') }}</label>
                            <input class="form-control {{ $errors->has('field') ? 'is-invalid' : '' }}" type="text" name="field" id="field" value="{{ old('field', $outputSkema->field) }}" required>
                            @if($errors->has('field'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('field') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.outputSkema.fields.field_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="mime">{{ trans('cruds.outputSkema.fields.mime') }}</label>
                            <input class="form-control {{ $errors->has('mime') ? 'is-invalid' : '' }}" type="text" name="mime" id="mime" value="{{ old('mime', $outputSkema->mime) }}">
                            @if($errors->has('mime'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mime') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.outputSkema.fields.mime_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div class="form-check {{ $errors->has('required') ? 'is-invalid' : '' }}">
                                <input type="hidden" name="required" value="0">
                                <input class="form-check-input" type="checkbox" name="required" id="required" value="1" {{ $outputSkema->required || old('required', 0) === 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="required">{{ trans('cruds.outputSkema.fields.required') }}</label>
                            </div>
                            @if($errors->has('required'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('required') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.outputSkema.fields.required_helper') }}</span>
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
