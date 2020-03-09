@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Fakultas' => route('admin.fakulta.index'),
        'Create' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('fakultum_view')
        {!! cui_toolbar_btn(route('admin.fakulta.index'), 'icon-list', trans('global.list').' '.trans('cruds.fakultum.title_singular') ) !!}
    @endcan
@stop
@section('content')
<div class="col">
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    {{ trans('global.create') }} {{ trans('cruds.fakultum.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("admin.fakulta.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="required" for="nama">{{ trans('cruds.fakultum.fields.nama') }}</label>
                            <input class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" type="text" name="nama" id="nama" value="{{ old('nama', '') }}" required>
                            @if($errors->has('nama'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nama') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.fakultum.fields.nama_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="singkatan">{{ trans('cruds.fakultum.fields.singkatan') }}</label>
                            <input class="form-control {{ $errors->has('singkatan') ? 'is-invalid' : '' }}" type="text" name="singkatan" id="singkatan" value="{{ old('singkatan', '') }}" required>
                            @if($errors->has('singkatan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('singkatan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.fakultum.fields.singkatan_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="kode">{{ trans('cruds.fakultum.fields.kode') }}</label>
                            <input class="form-control {{ $errors->has('kode') ? 'is-invalid' : '' }}" type="text" name="kode" id="kode" value="{{ old('kode', '') }}">
                            @if($errors->has('kode'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('kode') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.fakultum.fields.kode_helper') }}</span>
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
