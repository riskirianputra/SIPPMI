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
    @can('output_view')
        {!! cui_toolbar_btn(route('admin.outputs.index'), 'icon-list', trans('global.list').' '.trans('cruds.output.title_singular') ) !!}
    @endcan
@stop
@section('content')
<div class="col">
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    {{ trans('global.edit') }} {{ trans('cruds.output.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("admin.outputs.update", [$output->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="code">{{ trans('cruds.output.fields.code') }}</label>
                            <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code" id="code" value="{{ old('code', $output->code) }}" required>
                            @if($errors->has('code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('code') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.output.fields.code_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="jenis_usulan_id">{{ trans('cruds.output.fields.jenis_usulan') }}</label>
                            <select class="form-control select2 {{ $errors->has('jenis_usulan') ? 'is-invalid' : '' }}" name="jenis_usulan_id" id="jenis_usulan_id" required>
                                @foreach($jenis_usulans as $id => $jenis_usulan)
                                    <option value="{{ $id }}" {{ ($output->jenis_usulan ? $output->jenis_usulan->id : old('jenis_usulan_id')) == $id ? 'selected' : '' }}>{{ $jenis_usulan }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('jenis_usulan_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('jenis_usulan_id') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.output.fields.jenis_usulan_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="luaran">{{ trans('cruds.output.fields.luaran') }}</label>
                            <input class="form-control {{ $errors->has('luaran') ? 'is-invalid' : '' }}" type="text" name="luaran" id="luaran" value="{{ old('luaran', $output->luaran) }}" required>
                            @if($errors->has('luaran'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('luaran') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.output.fields.luaran_helper') }}</span>
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
