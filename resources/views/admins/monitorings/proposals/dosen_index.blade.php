@extends('layouts.admin')

@section('breadcrumb')
    {!!  cui_breadcrumb([
        'Home' => route('admin.home'),
        'Monitoring' => '#'
    ]) !!}
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <strong><i class="fa fa-filter"></i>Filter</strong>
        </div>

        <div class="card-body">
            @include('admins.monitorings.proposals.dosen_form')
        </div>
    </div>

    @if($dosens->count() > 0)
        <div class="card">
            <div class="card-header">
                <strong>Rekapitulasi Jumlah Proposal / Dosen</strong>
            </div>
            <div class="card-body">
                @include('admins.monitorings.proposals.dosen_table')
            </div>
        </div>
    @endif

@endsection
