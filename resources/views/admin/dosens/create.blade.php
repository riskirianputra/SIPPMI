@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Dosen' => route('admin.dosens.index'),
        'Create' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('dosen_view')
        {!! cui_toolbar_btn(route('admin.dosens.index'), 'icon-list', trans('global.list').' '.trans('cruds.dosen.title_singular') ) !!}
    @endcan
@stop
@section('content')
<div class="col">
    <div class="row">
        <dov class="col-sm-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    {{ trans('global.create') }} {{ trans('cruds.dosen.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("admin.dosens.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="required" for="nama">{{ trans('cruds.dosen.fields.nama') }}</label>
                            <input class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" type="text" name="nama" id="nama" value="{{ old('nama', '') }}" required>
                            @if($errors->has('nama'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nama') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.dosen.fields.nama_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="nip">{{ trans('cruds.dosen.fields.nip') }}</label>
                            <input class="form-control {{ $errors->has('nip') ? 'is-invalid' : '' }}" type="text" name="nip" id="nip" value="{{ old('nip', '') }}">
                            @if($errors->has('nip'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nip') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.dosen.fields.nip_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="nidn">{{ trans('cruds.dosen.fields.nidn') }}</label>
                            <input class="form-control {{ $errors->has('nidn') ? 'is-invalid' : '' }}" type="text" name="nidn" id="nidn" value="{{ old('nidn', '') }}">
                            @if($errors->has('nidn'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nidn') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.dosen.fields.nidn_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="email">{{ trans('cruds.dosen.fields.email') }}</label>
                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', '') }}" required>
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.dosen.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="prodi_id">{{ trans('cruds.dosen.fields.prodi') }}</label>
                            <select class="form-control select2 {{ $errors->has('prodi') ? 'is-invalid' : '' }}" name="prodi_id" id="prodi_id">
                                @foreach($prodis as $id => $prodi)
                                    <option value="{{ $id }}" {{ old('prodi_id') == $id ? 'selected' : '' }}>{{ $prodi }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('prodi_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('prodi_id') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.dosen.fields.prodi_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir">{{ trans('cruds.dosen.fields.tempat_lahir') }}</label>
                            <input class="form-control {{ $errors->has('tempat_lahir') ? 'is-invalid' : '' }}" type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir', '') }}">
                            @if($errors->has('tempat_lahir'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tempat_lahir') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.dosen.fields.tempat_lahir_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">{{ trans('cruds.dosen.fields.tanggal_lahir') }}</label>
                            <input class="form-control date {{ $errors->has('tanggal_lahir') ? 'is-invalid' : '' }}" type="text" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                            @if($errors->has('tanggal_lahir'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tanggal_lahir') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.dosen.fields.tanggal_lahir_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.dosen.fields.jabatan_fungsional') }}</label>
                            <select class="form-control {{ $errors->has('jabatan_fungsional') ? 'is-invalid' : '' }}" name="jabatan_fungsional" id="jabatan_fungsional">
                                <option value disabled {{ old('jabatan_fungsional', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Dosen::JABATAN_FUNGSIONAL_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('jabatan_fungsional', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('jabatan_fungsional'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('jabatan_fungsional') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.dosen.fields.jabatan_fungsional_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="status">{{ trans('cruds.dosen.fields.status') }}</label>
                            <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="text" name="status" id="status" value="{{ old('status', '') }}">
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.dosen.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.dosen.fields.jenis_kelamin') }}</label>
                            @foreach(App\Dosen::JENIS_KELAMIN_RADIO as $key => $label)
                                <div class="form-check {{ $errors->has('jenis_kelamin') ? 'is-invalid' : '' }}">
                                    <input class="form-check-input" type="radio" id="jenis_kelamin_{{ $key }}" name="jenis_kelamin" value="{{ $key }}" {{ old('jenis_kelamin', '') === (string) $key ? 'checked' : '' }}>
                                    <label class="form-check-label" for="jenis_kelamin_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('jenis_kelamin'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('jenis_kelamin') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.dosen.fields.jenis_kelamin_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.dosen.fields.pangkat_golongan') }}</label>
                            <select class="form-control {{ $errors->has('pangkat_golongan') ? 'is-invalid' : '' }}" name="pangkat_golongan" id="pangkat_golongan">
                                <option value disabled {{ old('pangkat_golongan', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Dosen::PANGKAT_GOLONGAN_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('pangkat_golongan', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('pangkat_golongan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('pangkat_golongan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.dosen.fields.pangkat_golongan_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="telepon">{{ trans('cruds.dosen.fields.telepon') }}</label>
                            <input class="form-control {{ $errors->has('telepon') ? 'is-invalid' : '' }}" type="text" name="telepon" id="telepon" value="{{ old('telepon', '') }}">
                            @if($errors->has('telepon'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('telepon') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.dosen.fields.telepon_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </dov>
    </div>
</div>
@endsection
