@extends('layouts.admin')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Skema' => route('admin.ref-skemas.index'),
        'Create' => '#'
    ]) !!}
@endsection

@section('toolbar')
    @can('ref_skema_view')
        {!! cui()->toolbar_btn(route('admin.ref-skemas.index'), 'cil-list', 'List Skema' ) !!}
    @endcan
@endsection

@section('content')
    <div class="col">
        <div class="row">

            <div class="col-sm-8">

                <div class="card">

                    {{ html()->form('POST', route('admin.ref-skemas.store'))->acceptsFiles()->open() }}

                    <div class="card-header font-weight-bold">
                        <i class="cil-plus"></i> Tambah Skema
                    </div>

                    <div class="card-body">
                        @include('admins.referensis.ref_skemas._form')
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-danger" type="submit">
                            Tambah
                        </button>
                    </div>

                    {{ html()->form()->close() }}

                </div>
            </div>
        </div>
    </div>
@endsection
