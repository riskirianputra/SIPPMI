@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Program Studi' => route('admin.prodis.index'),
        'Tambah' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('prodi_view')
        {!! cui()->toolbar_btn(route('admin.prodis.index'), 'cil-list', 'List Program Studi') !!}
    @endcan
@stop
@section('content')
<div class="col">
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    {{ trans('global.create') }} {{ trans('cruds.prodi.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("admin.prodis.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="required" for="nama">{{ trans('cruds.prodi.fields.nama') }}</label>
                            <input class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" type="text" name="nama" id="nama" value="{{ old('nama', '') }}" placeholder="{{ trans('cruds.prodi.fields.nama_helper') }}" required>
                            @if($errors->has('nama'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nama') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="fakultas_id">{{ trans('cruds.prodi.fields.fakultas') }}</label>
                            <select class="form-control select2 {{ $errors->has('fakultas') ? 'is-invalid' : '' }}" name="fakultas_id" id="fakultas_id">
                                @foreach($fakultas as $id => $fakultas)
                                    <option value="{{ $id }}" {{ old('fakultas_id') == $id ? 'selected' : '' }}>{{ $fakultas }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('fakultas_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fakultas_id') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="kode">{{ trans('cruds.prodi.fields.kode') }}</label>
                            <input class="form-control {{ $errors->has('kode') ? 'is-invalid' : '' }}" type="text" name="kode" id="kode" value="{{ old('kode', '') }}" placeholder="{{ trans('cruds.prodi.fields.kode_helper') }}">
                            @if($errors->has('kode'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('kode') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="kode_dikti">{{ trans('cruds.prodi.fields.kode_dikti') }}</label>
                            <input class="form-control {{ $errors->has('kode_dikti') ? 'is-invalid' : '' }}" type="text" name="kode_dikti" id="kode_dikti" value="{{ old('kode_dikti', '') }}" placeholder="{{ trans('cruds.prodi.fields.kode_dikti_helper') }}">
                            @if($errors->has('kode_dikti'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('kode_dikti') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="akreditasi">{{ trans('cruds.prodi.fields.akreditasi') }}</label>
                            <input class="form-control {{ $errors->has('akreditasi') ? 'is-invalid' : '' }}" type="text" name="akreditasi" id="akreditasi" value="{{ old('akreditasi', '') }}" placeholder="{{ trans('cruds.prodi.fields.akreditasi_helper') }}">
                            @if($errors->has('akreditasi'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('akreditasi') }}
                                </div>
                            @endif
                        </div>
                    </form>
                </div>

                <div class="card-footer">
                    <div class="form-group">
                        <button class="btn btn-danger" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
