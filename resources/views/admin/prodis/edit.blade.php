@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Program Studi' => route('admin.prodis.index'),
        'Edit' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('prodi_view')
        {!! cui_toolbar_btn(route('admin.prodis.index'), 'icon-list', trans('global.list').' '.trans('cruds.prodi.title_singular') ) !!}
    @endcan
@stop
@section('content')
<div class="col">
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    {{ trans('global.edit') }} {{ trans('cruds.prodi.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("admin.prodis.update", [$prodi->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="nama">{{ trans('cruds.prodi.fields.nama') }}</label>
                            <input class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" type="text" name="nama" id="nama" value="{{ old('nama', $prodi->nama) }}" required>
                            @if($errors->has('nama'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nama') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prodi.fields.nama_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="fakultas_id">{{ trans('cruds.prodi.fields.fakultas') }}</label>
                            <select class="form-control select2 {{ $errors->has('fakultas') ? 'is-invalid' : '' }}" name="fakultas_id" id="fakultas_id">
                                @foreach($fakultas as $id => $fakultas)
                                    <option value="{{ $id }}" {{ ($prodi->fakultas ? $prodi->fakultas->id : old('fakultas_id')) == $id ? 'selected' : '' }}>{{ $fakultas }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('fakultas_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fakultas_id') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prodi.fields.fakultas_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="kode">{{ trans('cruds.prodi.fields.kode') }}</label>
                            <input class="form-control {{ $errors->has('kode') ? 'is-invalid' : '' }}" type="text" name="kode" id="kode" value="{{ old('kode', $prodi->kode) }}">
                            @if($errors->has('kode'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('kode') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prodi.fields.kode_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="kode_dikti">{{ trans('cruds.prodi.fields.kode_dikti') }}</label>
                            <input class="form-control {{ $errors->has('kode_dikti') ? 'is-invalid' : '' }}" type="text" name="kode_dikti" id="kode_dikti" value="{{ old('kode_dikti', $prodi->kode_dikti) }}">
                            @if($errors->has('kode_dikti'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('kode_dikti') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prodi.fields.kode_dikti_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="akreditasi">{{ trans('cruds.prodi.fields.akreditasi') }}</label>
                            <input class="form-control {{ $errors->has('akreditasi') ? 'is-invalid' : '' }}" type="text" name="akreditasi" id="akreditasi" value="{{ old('akreditasi', $prodi->akreditasi) }}">
                            @if($errors->has('akreditasi'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('akreditasi') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prodi.fields.akreditasi_helper') }}</span>
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
