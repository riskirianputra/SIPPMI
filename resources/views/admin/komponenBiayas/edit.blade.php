@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.edit') }} {{ trans('cruds.komponenBiaya.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.komponen-biayas.update", [$komponenBiaya->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nama">{{ trans('cruds.komponenBiaya.fields.nama') }}</label>
                <input class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" type="text" name="nama" id="nama" value="{{ old('nama', $komponenBiaya->nama) }}" required>
                @if($errors->has('nama'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nama') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.komponenBiaya.fields.nama_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="keterangan">{{ trans('cruds.komponenBiaya.fields.keterangan') }}</label>
                <textarea class="form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}" name="keterangan" id="keterangan">{{ old('keterangan', $komponenBiaya->keterangan) }}</textarea>
                @if($errors->has('keterangan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('keterangan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.komponenBiaya.fields.keterangan_helper') }}</span>
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
