@extends('layouts.admin')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => url('home'),
        'Pengabdian' => route('pengabdians.index'),
        'Edit' => '#'
    ]) !!}
@endsection

@section('toolbar')
    @can('pengabdian_user_manage')
        {!! cui_toolbar_btn(route('pengabdians.index'), 'icon-list', 'List Pengabdian') !!}
    @endcan
@endsection

@section('styles')
    <style>
        .step-progressbar {
            list-style: none;
            counter-reset: step;
            display: flex;
            padding: 0;
        }

        .step-progressbar__item {
            display: flex;
            flex-direction: column;
            flex: 1;
            text-align: center;
            position: relative;
        }

        .step-progressbar__item:before {
            width: 3em;
            height: 3em;
            content: counter(step);
            counter-increment: step;
            align-self: center;
            background: #999;
            color: #fff;
            border-radius: 100%;
            line-height: 3em;
            margin-bottom: 0.5em;
        }

        .step-progressbar__item:after {
            height: 2px;
            width: calc(100% - 4em);
            content: '';
            background: #999;
            position: absolute;
            top: 1.5em;
            left: calc(50% + 2em);
        }

        .step-progressbar__item:last-child:after {
            content: none;
        }

        .step-progressbar__item--active:before {
            background: #000;
        }

        .step-progressbar__item--complete:before {
            content: '✔';
        }

    </style>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <ul class="step-progressbar">
                <li class="step-progressbar__item step-progressbar__item--complete"><a
                        href="{{ route('pengabdians.edit', [$pengabdian->id]) }}">Informasi Dasar</a></li>
                <li class="step-progressbar__item step-progressbar__item--complete"><a
                        href="{{ route('pengabdians.eksekutif', [$pengabdian->id]) }}">Ringkasan</a>
                <li>
                <li class="step-progressbar__item step-progressbar__item--active">Peneliti</li>
                <li class="step-progressbar__item">Submit</li>
            </ul>
        </div>
    </div>

    <div class="card">

        <div class="card-header">
            <strong>{{ trans('global.create') }} {{ trans('cruds.pengabdianAnggotum.title_singular') }}</strong>
        </div>

        <div class="card-body">

            @include('pengabdians._info')
{{--                form dosen--}}
            <div class="form-group row">
                <label for="file_proposal" class="col-sm-2 col-form-label">
                    <strong>Peneliti</strong>
                </label>
                <div class="col-sm-10">

                    <table class="table table-hover table-sm">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center">
                                Nama / NIP
                            </th>
                            <th class="text-center">
                                NIDN
                            </th>
                            <th scope="col" class="text-center">Prodi</th>
                            <th scope="col" class="text-center">Jabatan</th>
                            <th scope="col" class="text-center">Hapus</th>
                        </tr>
                        </thead>
                        <tbody>
                        <form method="POST"
                              action="{{ route("pengabdian.anggota.store", [$pengabdian->id]) }}"
                              enctype="multipart/form-data"
                              class="form form-inline">
                            @csrf
                            <tr>
                                <td colspan="3">
                                    <select
                                        class="custom-select select2 my-1 mr-sm-2 {{ $errors->has('dosen') ? 'is-invalid' : '' }}"
                                        name="dosen_id" id="dosen_id">

                                        @foreach($dosens as $id => $dosen)
                                            <option
                                                value="{{ $id }}" {{ old('dosen_id') == $id ? 'selected' : '' }}>{{ $dosen }}</option>
                                        @endforeach

                                    </select>
                                </td>
                                <td colspan="2">
                                    <button class="btn btn-danger btn-block" type="submit">Tambah Anggota</button>
                                </td>
                            </tr>
                        </form>
                        @foreach($pengabdian->usulan->anggotas->filter(function ($value,$key){return $value->tipe == 1;}) as $anggota)
                            <tr>
                                <td>
                                    {{ optional($anggota->dosen)->nama }} <br>
                                    <small><em>{{ optional($anggota->dosen)->nip }}</em></small>
                                </td>
                                <td>
                                    {{ optional($anggota->dosen)->nidn }}
                                </td>
                                <td>
                                    {{ optional($anggota->dosen->prodi)->nama }}
                                </td>
                                <td class="text-center">
                                    @if(isset($anggota->jabatan))
                                        {{ \App\PengabdianAnggotum::JABATAN_SELECT[$anggota->jabatan] }}
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($pengabdian->owner != $anggota->dosen_id)
                                        {!! cui()->btn_delete(route('pengabdian.anggota.destroy', [$pengabdian->id, $anggota->id]), trans('global.areYouSure')) !!}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
{{--            form mahasiswa--}}
            <div class="form-group row">
                <label for="file_proposal" class="col-sm-2 col-form-label">
                    <strong>Mahasiswa</strong>
                </label>
                <div class="col-sm-10">

                    <table class="table table-hover table-sm">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center">
                                Nama
                            </th>
                            <th scope="col" class="text-center">NIM</th>
                            <th scope="col" class="text-center">Prodi</th>
                            <th scope="col" class="text-center">Hapus</th>
                        </tr>
                        </thead>
                        <tbody>
                        <form method="POST"
                              action="{{ route("pengabdians.anggota-mahasiswa.store", [$pengabdian->id]) }}"
                              enctype="multipart/form-data"
                              class="form form-inline">
                            @csrf
                            <tr>
                                <td>
                                    {!! html()->text('nama')->placeholder('Nama Mahasiswa')->class(['form-control']) !!}
                                </td>
                                <td>
                                    {!! html()->text('identifier')->placeholder('NIM')->class(['form-control']) !!}
                                </td>
                                <td>
                                    <select
                                        class="custom-select select2 my-1 mr-sm-2 {{ $errors->has('unit') ? 'is-invalid' : '' }}"
                                        name="unit" id="unit">

                                        @foreach($prodis as $id => $prodi)
                                            <option
                                                value="{{ $prodi }}" {{ old('unit') == $id ? 'selected' : '' }}>{{ $prodi }}</option>
                                        @endforeach

                                    </select>
                                </td>
                                <td colspan="2">
                                    <button class="btn btn-danger btn-block" type="submit">Tambah Anggota</button>
                                </td>
                            </tr>
                        </form>
                        @foreach($pengabdian->usulan->anggotas->filter(function ($value,$key){return $value->tipe == 2;}) as $anggota)
                            <tr>
                                <td>
                                    {{ optional($anggota)->nama }}
                                </td>
                                <td>
                                    {{ optional($anggota)->identifier }}
                                </td>
                                <td>
                                    {{ optional($anggota)->unit }}
                                </td>
                                <td>
{{--                                    {{ optional($anggota->dosen->prodi)->nama }}--}}
                                </td>
                                <td class="text-center">
                                    @if($pengabdian->owner != $anggota->dosen_id)
                                        {!! cui()->btn_delete(route('pengabdian.anggota.destroy', [$pengabdian->id, $anggota->id]), trans('global.areYouSure')) !!}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <div class="card-footer">
            <a href="{{ route('pengabdians.eksekutif', $pengabdian) }}" class="btn btn-danger">Kembali</a>
            <a href="{{ route('pengabdians.review', $pengabdian->id) }}" class="btn btn-primary">Selanjutnya</a>
        </div>
    </div>


@endsection
