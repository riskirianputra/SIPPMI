@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Tema' => route('admin.rip-temas.index'),
        'Edit' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('rip_tema_view')
        {!! cui_toolbar_btn(route('admin.rip-temas.index'), 'icon-list', trans('global.list').' '.trans('cruds.ripTema.title_singular') ) !!}
    @endcan
@stop
@section('content')
<div class="col">
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    {{ trans('global.edit') }} {{ trans('cruds.ripTema.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("admin.rip-temas.update", [$ripTema->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="periode">{{ trans('cruds.ripTema.fields.periode') }}</label>
                            <input class="form-control {{ $errors->has('periode') ? 'is-invalid' : '' }}" type="text" name="periode" id="periode" value="{{ old('periode', $ripTema->periode) }}">
                            @if($errors->has('periode'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('periode') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ripTema.fields.periode_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="status">{{ trans('cruds.ripTema.fields.status') }}</label>
                            <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="number" name="status" id="status" value="{{ old('status', $ripTema->status) }}" step="1">
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ripTema.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="nama">{{ trans('cruds.ripTema.fields.nama') }}</label>
                            <input class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" type="text" name="nama" id="nama" value="{{ old('nama', $ripTema->nama) }}">
                            @if($errors->has('nama'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nama') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ripTema.fields.nama_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="luaran">{{ trans('cruds.ripTema.fields.luaran') }}</label>
                            <textarea class="form-control ckeditor {{ $errors->has('luaran') ? 'is-invalid' : '' }}" name="luaran" id="luaran">{!! old('luaran', $ripTema->luaran) !!}</textarea>
                            @if($errors->has('luaran'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('luaran') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ripTema.fields.luaran_helper') }}</span>
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
