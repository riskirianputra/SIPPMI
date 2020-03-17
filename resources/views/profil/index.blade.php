@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Profil' => '#'
    ]) !!}
@stop
@section('content')
<div class="card">
    <div class="card-header font-weight-bold">
        Profil
    </div>

    <div class="card-body">
        <div class="table-responsive">
                    <form method="POST" action="{{ route("profil.update", [$user->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

            <table class="table table-hover">

                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.dosen.fields.nama') }}
                        </th>
                        <td>
                            {{ optional($user->dosen)->nama }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dosen.fields.prodi') }}
                        </th>
                        <td>
                            {{ optional(optional($user->dosen)->prodi)->nama }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dosen.fields.nip') }}
                        </th>
                        <td>

                            <input class="form-control {{ $errors->has('nip') ? 'is-invalid' : '' }}" type="text" name="nip" id="nip" value="{{ old('nip', optional($user->dosen)->nip) }}">

                            @if($errors->has('nip'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nip') }}
                                </div>
                            @endif

                            <span class="help-block">{{ trans('cruds.dosen.fields.nip_helper') }}</span>
                            <!-- {{ optional($user->dosen)->nip }} -->

                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dosen.fields.nidn') }}
                        </th>
                        <td>
                            {{ optional($user->dosen)->nidn }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dosen.fields.tempat_lahir') }}
                        </th>
                        <td>

                            <input class="form-control {{ $errors->has('tempat_lahir') ? 'is-invalid' : '' }}" type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir', optional($user->dosen)->tempat_lahir) }}">
                            @if($errors->has('tempat_lahir'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tempat_lahir') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.dosen.fields.tempat_lahir_helper') }}</span>
                            <!-- {{ optional($user->dosen)->tempat_lahir }} -->

                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dosen.fields.tanggal_lahir') }}
                        </th>
                        <td>

                            <input class="form-control datepicker {{ $errors->has('tanggal_lahir') ? 'is-invalid' : '' }}" type="date" name="tanggal_lahir" id="tanggal_lahir"
                             value="{{ old('tanggal_lahir', optional($user->dosen)->tanggal_lahir) }}" placeholder="yyyy-mm-dd">
                            @if($errors->has('tanggal_lahir'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tanggal_lahir') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.dosen.fields.tanggal_lahir_helper') }}</span>
                            <!-- {{ optional($user->dosen)->tanggal_lahir }} -->

                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dosen.fields.jabatan_fungsional') }}
                        </th>
                        <td>
                            {{ App\Dosen::JABATAN_FUNGSIONAL_SELECT[optional($user->dosen)->jabatan_fungsional] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dosen.fields.status') }}
                        </th>
                        <td>

                            <!-- {{ optional($user->dosen)->status }} -->

                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dosen.fields.email') }}
                        </th>
                        <td>

                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', optional($user->dosen)->email) }}">
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.dosen.fields.email_helper') }}</span>
                            <!-- {{ optional($user->dosen)->email }} -->

                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dosen.fields.pangkat_golongan') }}
                        </th>
                        <td>
                            {{ optional($user->dosen)->pangkat_golongan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dosen.fields.telepon') }}
                        </th>
                        <td>

                            <input class="form-control {{ $errors->has('telepon') ? 'is-invalid' : '' }}" type="text" name="telepon" id="telepon" value="{{ old('telepon', optional($user->dosen)->telepon) }}">
                            @if($errors->has('telepon'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('telepon') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.dosen.fields.telepon_helper') }}</span>
                            <!-- {{ optional($user->dosen)->telepon }} -->
                        </td>
                    </tr>
                    <tr>

                        <td colspan=2>
                            <button class="btn btn-danger " type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </td>

                    </tr>

                </tbody>
            </table>
    </form>
        </div>
    </div>
</div>
@stop
