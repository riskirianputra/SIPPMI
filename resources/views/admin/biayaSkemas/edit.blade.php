@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.edit') }} {{ trans('cruds.biayaSkema.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.biaya-skemas.update", [$biayaSkema->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="biaya_id">{{ trans('cruds.biayaSkema.fields.biaya') }}</label>
                <select class="form-control select2 {{ $errors->has('biaya') ? 'is-invalid' : '' }}" name="biaya_id" id="biaya_id">
                    @foreach($biayas as $id => $biaya)
                        <option value="{{ $id }}" {{ ($biayaSkema->biaya ? $biayaSkema->biaya->id : old('biaya_id')) == $id ? 'selected' : '' }}>{{ $biaya }}</option>
                    @endforeach
                </select>
                @if($errors->has('biaya_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('biaya_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.biayaSkema.fields.biaya_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="persen_max">{{ trans('cruds.biayaSkema.fields.persen_max') }}</label>
                <input class="form-control {{ $errors->has('persen_max') ? 'is-invalid' : '' }}" type="number" name="persen_max" id="persen_max" value="{{ old('persen_max', $biayaSkema->persen_max) }}" step="0.01" max="100">
                @if($errors->has('persen_max'))
                    <div class="invalid-feedback">
                        {{ $errors->first('persen_max') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.biayaSkema.fields.persen_max_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="persen_min">{{ trans('cruds.biayaSkema.fields.persen_min') }}</label>
                <input class="form-control {{ $errors->has('persen_min') ? 'is-invalid' : '' }}" type="number" name="persen_min" id="persen_min" value="{{ old('persen_min', $biayaSkema->persen_min) }}" step="0.01" max="100">
                @if($errors->has('persen_min'))
                    <div class="invalid-feedback">
                        {{ $errors->first('persen_min') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.biayaSkema.fields.persen_min_helper') }}</span>
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
