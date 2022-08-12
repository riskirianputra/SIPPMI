@extends('layouts.admin')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => url('home'),
        'Kinerja' => route('pemakalahs.index'),
        'Pemakalah' => route('pemakalahs.index'),
        'Tambah' => '#'
    ]) !!}
@endsection

@section('toolbar')
    @can('kinerja_user_manage')
        {!! cui_toolbar_btn(route('pemakalahs.index'), 'cil-list', 'List Makalah') !!}
    @endcan
@endsection

@section('content')

    <div class="card">
        <div class="card-header font-weight-bold">Detail Makalah</div>

        <div class="card-body">
            @include('kinerjas.pemakalahs._info')

            <div class="form-group row">
                <div class="col-sm-2">
                    <strong>Peneliti</strong>
                </div>
                <div class="col-sm-10">
                    @include('kinerjas.pemakalahs.anggotas._info')
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-2">
                    <strong>Mahasiswa</strong>
                </div>
                <div class="col-sm-10">
                    @include('kinerjas.pemakalahs.anggotas._mahasiswa')
                </div>
            </div>
        </div>
    </div>

@endsection
