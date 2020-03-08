@extends('layouts.admin')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => url('home'),
        'Penelitian' => '#'
    ]) !!}
@endsection

@section('toolbar')
    @can('manage_penelitian_user')
        {!! cui_toolbar_btn(route('penelitians.index'), 'icon-list', 'List Penelitian') !!}
    @endcan
@endsection


@section('content')
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">
                    <strong>Informasi Detail Usulan Penelitian</strong>
                </div>

                <div class="card-body">

                    @include('penelitians._detail')

                    <div class="form-group row">
                        <label for="judul" class="col-sm-2 col-form-label">
                            <strong>Peneliti</strong>
                        </label>
                        <div class="col-sm-10">
                            @include('penelitians.anggota._info')
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="judul" class="col-sm-2 col-form-label">
                            <strong>Mahasiswa</strong>
                        </label>
                        <div class="col-sm-10">
                            @include('penelitians.anggota._mahasiswa')
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-sm-2">
                            <strong>Ringkasan Eksekutif</strong>
                        </div>
                        <div class="col-sm-10">
                            {!! $penelitian->ringkasan_eksekutif_simple !!}
                        </div>
                    </div>
                </div>

                <div class="card-footer">

                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card border-warning mb-3">
                <div class="card-header">
                    <strong>Komentar/Peringatan</strong>
                </div>

                <div class="card-body text-warning">
                    @include('admin.usulanKomentars.index')
                </div>

            </div>
        </div>

    </div>

@endsection
