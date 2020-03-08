@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Tahapan Reviewer' => route('admin.tahapan-reviews.index'),
        'Create' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('tahapan_review_view')
        {!! cui_toolbar_btn(route('admin.tahapan-reviews.index'), 'icon-list', trans('global.list').' '.trans('cruds.tahapanReview.title_singular') ) !!}
    @endcan
@stop
@section('content')
<div class="col">
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    {{ trans('global.create') }} {{ trans('cruds.tahapanReview.title_singular') }}
                </div>
                <form method="POST" action="{{ route("admin.tahapan-reviews.store") }}" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label class="required" for="nama">{{ trans('cruds.tahapanReview.fields.nama') }}</label>
                            <input class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" type="text" name="nama" id="nama" value="{{ old('nama', '') }}" required>
                            @if($errors->has('nama'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nama') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tahapanReview.fields.nama_helper') }}</span>
                        </div>

                        <div class="form-group">
                            <label>{{ trans('cruds.tahapanReview.fields.jumlah_reviewer') }}</label>
                            <select class="form-control {{ $errors->has('jumlah_reviewer') ? 'is-invalid' : '' }}" name="jumlah_reviewer" id="jumlah_reviewer">
                                <option value disabled {{ old('jumlah_reviewer', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\TahapanReview::JUMLAH_REVIEWER as $key => $label)
                                    <option value="{{ $key }}" {{ old('jumlah_reviewer', 'P') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('jumlah_reviewer'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('jumlah_reviewer') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tahapanReview.fields.jumlah_reviewer_helper') }}</span>
                        </div>

                        <div class="form-group">
                            <label class="required" for="tahun">{{ trans('cruds.tahapanReview.fields.tahun') }}</label>
                            <input class="form-control {{ $errors->has('tahun') ? 'is-invalid' : '' }}" type="number" name="tahun" id="tahun" value="{{ old('tahun') }}" step="1" required>
                            @if($errors->has('tahun'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tahun') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tahapanReview.fields.tahun_helper') }}</span>
                        </div>

                        <div class="form-group">
                            <label for="mulai">{{ trans('cruds.tahapanReview.fields.mulai') }}</label>
                            <input class="form-control date {{ $errors->has('mulai') ? 'is-invalid' : '' }}" type="date" name="mulai" id="mulai" value="{{ old('mulai') }}">
                            @if($errors->has('mulai'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mulai') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tahapanReview.fields.mulai_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="selesai">{{ trans('cruds.tahapanReview.fields.selesai') }}</label>
                            <input class="form-control date {{ $errors->has('selesai') ? 'is-invalid' : '' }}" type="date" name="selesai" id="selesai" value="{{ old('selesai') }}">
                            @if($errors->has('selesai'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('selesai') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.tahapanReview.fields.selesai_helper') }}</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
