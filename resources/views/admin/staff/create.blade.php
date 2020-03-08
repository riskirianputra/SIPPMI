@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Staff' => route('admin.staff.index'),
        'Create' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('staff_view')
        {!! cui_toolbar_btn(route('admin.staff.index'), 'icon-list', trans('global.list').' '.trans('cruds.staff.title_singular') ) !!}
    @endcan
@stop
@section('content')
<div class="col">
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    {{ trans('global.create') }} {{ trans('cruds.staff.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("admin.staff.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="required" for="nama">{{ trans('cruds.staff.fields.nama') }}</label>
                            <input class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" type="text" name="nama" id="nama" value="{{ old('nama', '') }}" required>
                            @if($errors->has('nama'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nama') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.staff.fields.nama_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="nip">{{ trans('cruds.staff.fields.nip') }}</label>
                            <input class="form-control {{ $errors->has('nip') ? 'is-invalid' : '' }}" type="text" name="nip" id="nip" value="{{ old('nip', '') }}">
                            @if($errors->has('nip'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nip') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.staff.fields.nip_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="email">{{ trans('cruds.staff.fields.email') }}</label>
                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', '') }}" required>
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.staff.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir">{{ trans('cruds.staff.fields.tempat_lahir') }}</label>
                            <input class="form-control {{ $errors->has('tempat_lahir') ? 'is-invalid' : '' }}" type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir', '') }}">
                            @if($errors->has('tempat_lahir'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tempat_lahir') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.staff.fields.tempat_lahir_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">{{ trans('cruds.staff.fields.tanggal_lahir') }}</label>
                            <input class="form-control date {{ $errors->has('tanggal_lahir') ? 'is-invalid' : '' }}" type="text" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                            @if($errors->has('tanggal_lahir'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tanggal_lahir') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.staff.fields.tanggal_lahir_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="status">{{ trans('cruds.staff.fields.status') }}</label>
                            <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="text" name="status" id="status" value="{{ old('status', '') }}">
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.staff.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.staff.fields.jenis_kelamin') }}</label>
                            @foreach(App\Staff::JENIS_KELAMIN_RADIO as $key => $label)
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
                            <span class="help-block">{{ trans('cruds.staff.fields.jenis_kelamin_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="telepon">{{ trans('cruds.staff.fields.telepon') }}</label>
                            <input class="form-control {{ $errors->has('telepon') ? 'is-invalid' : '' }}" type="text" name="telepon" id="telepon" value="{{ old('telepon', '') }}">
                            @if($errors->has('telepon'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('telepon') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.staff.fields.telepon_helper') }}</span>
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
