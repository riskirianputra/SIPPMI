@extends('layouts.admin')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => url('home'),
        'Pengabdian' => '#'
    ]) !!}
@endsection

@section('toolbar')
    @can('manage_pengabdian_user')
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
                <li class="step-progressbar__item step-progressbar__item--complete"><a
                        href="{{ route('pengabdian.anggota.create', [$pengabdian->id]) }}">Peneliti</a>
                <li>
                <li class="step-progressbar__item">Submit</li>
            </ul>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Informasi Detail Usulan pengabdian
        </div>

        <div class="card-body">
            @include('pengabdians._detail')

            <div class="form-group row">
                <div class="col-sm-2">
                    <strong>Peneliti</strong>
                </div>
                <div class="col-sm-10">
                    @include('pengabdians.anggota._info')
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-2">
                    <strong>Mahasiswa</strong>
                </div>
                <div class="col-sm-10">
                    @include('pengabdians.anggota._mahasiswa')
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-2">
                    <strong>Ringkasan Eksekutif</strong>
                </div>
                <div class="col-sm-10">
                    {!! $pengabdian->ringkasan_eksekutif_simple !!}
                </div>
            </div>
        </div>

        <div class="card-footer">

            <form action="{{ route('pengabdians.submit', $pengabdian->id) }}" method="POST">
                @csrf
                <a href="{{ route('pengabdian.anggota.create', $pengabdian) }}" class="btn btn-danger">Kembali</a>
                <button type="submit" class="btn-success btn">Submit Proposal</button>
            </form>
        </div>
    </div>

@endsection
