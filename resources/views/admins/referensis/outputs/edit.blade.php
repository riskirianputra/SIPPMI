@extends('layouts.admin')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Skema' => route('admin.ref-skemas.index'),
        'Output' => route('admin.outputs.index'),
        'Create' => '#'
    ]) !!}
@endsection

@section('toolbar')
    @can('output_view')
        {!! cui()->toolbar_btn(route('admin.outputs.index'), 'cil-list', trans('global.list').' '.trans('cruds.output.title_singular') ) !!}
    @endcan
@endsection

@section('content')
<div class="col">
    <div class="row">
        <div class="col-sm-8">
            {{ html()->modelForm($output, 'PATCH', route('admin.outputs.update', [$output->id]))->acceptsFiles()->open() }}

            <div class="card">
                <div class="card-header font-weight-bold">
                    <i class="cil-pencil"></i> Edit Jenis Output
                </div>

                <div class="card-body">
                    @include('admins.referensis.outputs._form')
                </div>

                <div class="card-footer">
                    <button class="btn btn-primary" type="submit">
                        Tambah
                    </button>
                </div>

            </div>
            {{ html()->closeModelForm() }}
        </div>
    </div>
</div>
@endsection
