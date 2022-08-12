@extends('layouts.admin')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Skema' => route('admin.ref-skemas.index'),
        'Edit' => '#'
    ]) !!}
@endsection

@section('toolbar')
    @can('ref_skema_view')
        {!! cui_toolbar_btn(route('admin.ref-skemas.index'), 'cil-list', 'List Skema' ) !!}
    @endcan
@endsection

@section('content')
<div class="col">
    <div class="row">
        <div class="col-sm-8">

            {{ html()->modelForm($refSkema, 'PATCH', route('admin.ref-skemas.update', [$refSkema]))->acceptsFiles()->open() }}

            <div class="card">

                <div class="card-header font-weight-bold">
                    <i class="cil-pencil"></i> Edit Skema
                </div>

                <div class="card-body">
                    @include('admins.referensis.ref_skemas._form')
                </div>

                <div class="card-footer">
                    <button class="btn btn-danger" type="submit">
                        Simpan
                    </button>
                </div>

                {{ html()->closeModelForm() }}
            </div>
        </div>
    </div>
</div>
@endsection
