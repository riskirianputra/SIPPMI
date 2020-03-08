@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Biaya Penelitian' => route('admin.penelitian-biayas.index'),
        'Edit' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('penelitian_biaya_view')
        {!! cui_toolbar_btn(route('admin.penelitian-biayas.index'), 'icon-list', trans('global.list').' '.trans('cruds.penelitianBiaya.title_singular') ) !!}
    @endcan
@stop
@section('content')
<div class="col">
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    {{ trans('global.edit') }} {{ trans('cruds.penelitianBiaya.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("admin.penelitian-biayas.update", [$penelitianBiaya->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="biaya_skema_id">{{ trans('cruds.penelitianBiaya.fields.biaya_skema') }}</label>
                            <select class="form-control select2 {{ $errors->has('biaya_skema') ? 'is-invalid' : '' }}" name="biaya_skema_id" id="biaya_skema_id">
                                @foreach($biaya_skemas as $id => $biaya_skema)
                                    <option value="{{ $id }}" {{ ($penelitianBiaya->biaya_skema ? $penelitianBiaya->biaya_skema->id : old('biaya_skema_id')) == $id ? 'selected' : '' }}>{{ $biaya_skema }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('biaya_skema_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('biaya_skema_id') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.penelitianBiaya.fields.biaya_skema_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="penelitian_id">{{ trans('cruds.penelitianBiaya.fields.penelitian') }}</label>
                            <select class="form-control select2 {{ $errors->has('penelitian') ? 'is-invalid' : '' }}" name="penelitian_id" id="penelitian_id">
                                @foreach($penelitians as $id => $penelitian)
                                    <option value="{{ $id }}" {{ ($penelitianBiaya->penelitian ? $penelitianBiaya->penelitian->id : old('penelitian_id')) == $id ? 'selected' : '' }}>{{ $penelitian }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('penelitian_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('penelitian_id') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.penelitianBiaya.fields.penelitian_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="jumlah">{{ trans('cruds.penelitianBiaya.fields.jumlah') }}</label>
                            <input class="form-control {{ $errors->has('jumlah') ? 'is-invalid' : '' }}" type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', $penelitianBiaya->jumlah) }}" step="0.01" required>
                            @if($errors->has('jumlah'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('jumlah') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.penelitianBiaya.fields.jumlah_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="jumlah_final">{{ trans('cruds.penelitianBiaya.fields.jumlah_final') }}</label>
                            <input class="form-control {{ $errors->has('jumlah_final') ? 'is-invalid' : '' }}" type="number" name="jumlah_final" id="jumlah_final" value="{{ old('jumlah_final', $penelitianBiaya->jumlah_final) }}" step="0.01">
                            @if($errors->has('jumlah_final'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('jumlah_final') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.penelitianBiaya.fields.jumlah_final_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="satuan">{{ trans('cruds.penelitianBiaya.fields.satuan') }}</label>
                            <input class="form-control {{ $errors->has('satuan') ? 'is-invalid' : '' }}" type="text" name="satuan" id="satuan" value="{{ old('satuan', $penelitianBiaya->satuan) }}" required>
                            @if($errors->has('satuan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('satuan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.penelitianBiaya.fields.satuan_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="harga_satuan">{{ trans('cruds.penelitianBiaya.fields.harga_satuan') }}</label>
                            <input class="form-control {{ $errors->has('harga_satuan') ? 'is-invalid' : '' }}" type="number" name="harga_satuan" id="harga_satuan" value="{{ old('harga_satuan', $penelitianBiaya->harga_satuan) }}" step="1" required>
                            @if($errors->has('harga_satuan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('harga_satuan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.penelitianBiaya.fields.harga_satuan_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="harga_satuan_final">{{ trans('cruds.penelitianBiaya.fields.harga_satuan_final') }}</label>
                            <input class="form-control {{ $errors->has('harga_satuan_final') ? 'is-invalid' : '' }}" type="number" name="harga_satuan_final" id="harga_satuan_final" value="{{ old('harga_satuan_final', $penelitianBiaya->harga_satuan_final) }}" step="1">
                            @if($errors->has('harga_satuan_final'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('harga_satuan_final') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.penelitianBiaya.fields.harga_satuan_final_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="justifikasi">{{ trans('cruds.penelitianBiaya.fields.justifikasi') }}</label>
                            <textarea class="form-control {{ $errors->has('justifikasi') ? 'is-invalid' : '' }}" name="justifikasi" id="justifikasi">{{ old('justifikasi', $penelitianBiaya->justifikasi) }}</textarea>
                            @if($errors->has('justifikasi'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('justifikasi') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.penelitianBiaya.fields.justifikasi_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="status">{{ trans('cruds.penelitianBiaya.fields.status') }}</label>
                            <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="text" name="status" id="status" value="{{ old('status', $penelitianBiaya->status) }}">
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.penelitianBiaya.fields.status_helper') }}</span>
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
