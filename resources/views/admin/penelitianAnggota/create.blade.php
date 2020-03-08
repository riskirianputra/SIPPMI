@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Anggota Penelitian' => route('admin.penelitian-anggota.index'),
        'Create' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('penelitian_anggotum_view')
        {!! cui_toolbar_btn(route('admin.penelitian-anggota.index'), 'icon-list', trans('global.list').' '.trans('cruds.penelitianAnggotum.title_singular') ) !!}
    @endcan
@stop
@section('content')
<div class="col">
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    {{ trans('global.create') }} {{ trans('cruds.penelitianAnggotum.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("admin.penelitian-anggota.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="dosen_id">{{ trans('cruds.penelitianAnggotum.fields.dosen') }}</label>
                            <select class="form-control select2 {{ $errors->has('dosen') ? 'is-invalid' : '' }}" name="dosen_id" id="dosen_id">
                                @foreach($dosens as $id => $dosen)
                                    <option value="{{ $id }}" {{ old('dosen_id') == $id ? 'selected' : '' }}>{{ $dosen }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('dosen_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('dosen_id') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.penelitianAnggotum.fields.dosen_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="penelitian_id">{{ trans('cruds.penelitianAnggotum.fields.penelitian') }}</label>
                            <select class="form-control select2 {{ $errors->has('penelitian') ? 'is-invalid' : '' }}" name="penelitian_id" id="penelitian_id">
                                @foreach($penelitians as $id => $penelitian)
                                    <option value="{{ $id }}" {{ old('penelitian_id') == $id ? 'selected' : '' }}>{{ $penelitian }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('penelitian_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('penelitian_id') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.penelitianAnggotum.fields.penelitian_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.penelitianAnggotum.fields.jabatan') }}</label>
                            <select class="form-control {{ $errors->has('jabatan') ? 'is-invalid' : '' }}" name="jabatan" id="jabatan">
                                <option value disabled {{ old('jabatan', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\PenelitianAnggotum::JABATAN_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('jabatan', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('jabatan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('jabatan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.penelitianAnggotum.fields.jabatan_helper') }}</span>
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
