@extends('layouts.admin')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Review' => '#'
]) !!}
@endsection

@section('toolbar')

@endsection

@section('content')

    <div class="card text-white bg-danger">
        <div class="card-header">Info</div>

        <div class="card-body">
            <h5>Bukan jadwal review penelitian atau tidak ada penelitian yang akan direview</h5>
        </div>

    </div>

@endsection
