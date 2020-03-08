@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Anggota Pengabdian' => route('admin.pengabdian-anggota.index'),
        'Create' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('pengabdian_anggotum_view')
        {!! cui_toolbar_btn(route('admin.pengabdian-anggota.index'), 'icon-list', trans('global.list').' '.trans('cruds.pengabdianAnggotum.title_singular') ) !!}
    @endcan
@stop
@section('content')
<div class="col">
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    {{ trans('global.create') }} {{ trans('cruds.pengabdianAnggotum.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("admin.pengabdian-anggota.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="pengabdian_id">{{ trans('cruds.pengabdianAnggotum.fields.pengabdian') }}</label>
                            <select class="form-control select2 {{ $errors->has('pengabdian') ? 'is-invalid' : '' }}" name="pengabdian_id" id="pengabdian_id">
                                @foreach($pengabdians as $id => $pengabdian)
                                    <option value="{{ $id }}" {{ old('pengabdian_id') == $id ? 'selected' : '' }}>{{ $pengabdian }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('pengabdian_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('pengabdian_id') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pengabdianAnggotum.fields.pengabdian_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="dosen_id">{{ trans('cruds.pengabdianAnggotum.fields.dosen') }}</label>
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
                            <span class="help-block">{{ trans('cruds.pengabdianAnggotum.fields.dosen_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.pengabdianAnggotum.fields.jabatan') }}</label>
                            <select class="form-control {{ $errors->has('jabatan') ? 'is-invalid' : '' }}" name="jabatan" id="jabatan">
                                <option value disabled {{ old('jabatan', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\PengabdianAnggotum::JABATAN_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('jabatan', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('jabatan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('jabatan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pengabdianAnggotum.fields.jabatan_helper') }}</span>
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
