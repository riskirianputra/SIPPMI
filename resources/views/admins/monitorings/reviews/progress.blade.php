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
            @include('admins.monitorings.reviews.progress_form')
        </div>
    </div>

    @if($usulans->count() > 0)
        <div class="card">
            <div class="card-header">
                <strong>Rekapitulasi/Progress Review </strong>
            </div>
            <div class="card-body">
                @include('admins.monitorings.reviews.progress_table')
            </div>
        </div>
    @endif

@endsection
