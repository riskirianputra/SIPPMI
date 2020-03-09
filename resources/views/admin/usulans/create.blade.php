@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.usulan.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.usulans.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="pengusul_id">{{ trans('cruds.usulan.fields.pengusul') }}</label>
                <select class="form-control select2 {{ $errors->has('pengusul') ? 'is-invalid' : '' }}" name="pengusul_id" id="pengusul_id">
                    @foreach($pengusuls as $id => $pengusul)
                        <option value="{{ $id }}" {{ old('pengusul_id') == $id ? 'selected' : '' }}>{{ $pengusul }}</option>
                    @endforeach
                </select>
                @if($errors->has('pengusul_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pengusul_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.usulan.fields.pengusul_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.usulan.fields.status_usulan') }}</label>
                <select class="form-control {{ $errors->has('status_usulan') ? 'is-invalid' : '' }}" name="status_usulan" id="status_usulan">
                    <option value disabled {{ old('status_usulan', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Usulan::STATUS_USULAN_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status_usulan', '0') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status_usulan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status_usulan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.usulan.fields.status_usulan_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.usulan.fields.jenis_usulan') }}</label>
                <select class="form-control {{ $errors->has('jenis_usulan') ? 'is-invalid' : '' }}" name="jenis_usulan" id="jenis_usulan">
                    <option value disabled {{ old('jenis_usulan', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Usulan::JENIS_USULAN_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('jenis_usulan', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('jenis_usulan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('jenis_usulan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.usulan.fields.jenis_usulan_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection