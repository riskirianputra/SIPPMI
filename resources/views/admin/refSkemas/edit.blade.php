@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Skema' => route('admin.ref-skemas.index'),
        'Edit' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('ref_skema_view')
        {!! cui_toolbar_btn(route('admin.ref-skemas.index'), 'icon-list', trans('global.list').' '.trans('cruds.refSkema.title_singular') ) !!}
    @endcan
@stop
@section('content')
<div class="col">
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    {{ trans('global.edit') }} {{ trans('cruds.refSkema.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("admin.ref-skemas.update", [$refSkema->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label>{{ trans('cruds.refSkema.fields.jenis_usulan') }}</label>
                            <select class="form-control {{ $errors->has('jenis_usulan') ? 'is-invalid' : '' }}" name="jenis_usulan" id="jenis_usulan">
                                <option value disabled {{ old('jenis_usulan', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\RefSkema::JENIS_USULAN_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('jenis_usulan', $refSkema->jenis_usulan) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('jenis_usulan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('jenis_usulan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.refSkema.fields.jenis_usulan_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="nama">{{ trans('cruds.refSkema.fields.nama') }}</label>
                            <input class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" type="text" name="nama" id="nama" value="{{ old('nama', $refSkema->nama) }}">
                            @if($errors->has('nama'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nama') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.refSkema.fields.nama_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="jangka_waktu">{{ trans('cruds.refSkema.fields.jangka_waktu') }}</label>
                            <input class="form-control {{ $errors->has('jangka_waktu') ? 'is-invalid' : '' }}" type="number" name="jangka_waktu" id="jangka_waktu" value="{{ old('jangka_waktu', $refSkema->jangka_waktu) }}" step="1">
                            @if($errors->has('jangka_waktu'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('jangka_waktu') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.refSkema.fields.jangka_waktu_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="biaya_minimal">{{ trans('cruds.refSkema.fields.biaya_minimal') }}</label>
                            <input class="form-control {{ $errors->has('biaya_minimal') ? 'is-invalid' : '' }}" type="number" name="biaya_minimal" id="biaya_minimal" value="{{ old('biaya_minimal', $refSkema->biaya_minimal) }}" step="0.01">
                            @if($errors->has('biaya_minimal'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('biaya_minimal') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.refSkema.fields.biaya_minimal_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="biaya_maksimal">{{ trans('cruds.refSkema.fields.biaya_maksimal') }}</label>
                            <input class="form-control {{ $errors->has('biaya_maksimal') ? 'is-invalid' : '' }}" type="number" name="biaya_maksimal" id="biaya_maksimal" value="{{ old('biaya_maksimal', $refSkema->biaya_maksimal) }}" step="0.01">
                            @if($errors->has('biaya_maksimal'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('biaya_maksimal') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.refSkema.fields.biaya_maksimal_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="sumber_dana">{{ trans('cruds.refSkema.fields.sumber_dana') }}</label>
                            <input class="form-control {{ $errors->has('sumber_dana') ? 'is-invalid' : '' }}" type="text" name="sumber_dana" id="sumber_dana" value="{{ old('sumber_dana', $refSkema->sumber_dana) }}">
                            @if($errors->has('sumber_dana'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sumber_dana') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.refSkema.fields.sumber_dana_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="anggota_min">{{ trans('cruds.refSkema.fields.anggota_min') }}</label>
                            <input class="form-control {{ $errors->has('anggota_min') ? 'is-invalid' : '' }}" type="text" name="anggota_min" id="anggota_min" value="{{ old('anggota_min', $refSkema->anggota_min) }}">
                            @if($errors->has('anggota_min'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('anggota_min') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.refSkema.fields.anggota_min_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="anggota_max">{{ trans('cruds.refSkema.fields.anggota_max') }}</label>
                            <input class="form-control {{ $errors->has('anggota_max') ? 'is-invalid' : '' }}" type="text" name="anggota_max" id="anggota_max" value="{{ old('anggota_max', $refSkema->anggota_max) }}">
                            @if($errors->has('anggota_max'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('anggota_max') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.refSkema.fields.anggota_max_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="mahasiswa_min">Jumlah Mahasiswa Min</label>
                            <input class="form-control {{ $errors->has('mahasiswa_min') ? 'is-invalid' : '' }}" type="number" name="mahasiswa_min" id="mahasiswa_min" value="{{ old('mahasiswa_min', $refSkema->mahasiswa_min) }}">
                            @if($errors->has('mahasiswa_min'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mahasiswa_min') }}
                                </div>
                            @endif
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="mahasiswa_max">Jumlah Mahasiswa Max</label>
                            <input class="form-control {{ $errors->has('mahasiswa_max') ? 'is-invalid' : '' }}" type="number" name="mahasiswa_max" id="mahasiswa_max" value="{{ old('mahasiswa_max', $refSkema->mahasiswa_max) }}">
                            @if($errors->has('mahasiswa_max'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mahasiswa_max') }}
                                </div>
                            @endif
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_mulai">{{ trans('cruds.refSkema.fields.tanggal_mulai') }}</label>
                            <input class="form-control date {{ $errors->has('tanggal_mulai') ? 'is-invalid' : '' }}" type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{ old('tanggal_mulai', $refSkema->tanggal_mulai) }}">
                            @if($errors->has('tanggal_mulai'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tanggal_mulai') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.refSkema.fields.tanggal_mulai_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_selesai">{{ trans('cruds.refSkema.fields.tanggal_selesai') }}</label>
                            <input class="form-control date {{ $errors->has('tanggal_selesai') ? 'is-invalid' : '' }}" type="date" name="tanggal_selesai" id="tanggal_selesai" value="{{ old('tanggal_selesai', $refSkema->tanggal_selesai) }}">
                            @if($errors->has('tanggal_selesai'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tanggal_selesai') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.refSkema.fields.tanggal_selesai_helper') }}</span>
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
