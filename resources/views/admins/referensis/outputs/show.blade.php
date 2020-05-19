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
    @can('ref_skema_manage')
        {!! cui()->toolbar_btn(route('admin.ref-skemas.index'), 'cil-list', 'List Skema' ) !!}
    @endcan
    @can('output_manage')
        {!! cui()->toolbar_btn(route('admin.outputs.index'), 'cil-list', 'List Output' ) !!}
        {!! cui()->toolbar_btn(route('admin.outputs.edit',[$output->id]), 'cil-pencil', 'Edit' ) !!}
        {!! cui()->toolbar_delete(route('admin.outputs.destroy',[$output->id]), $output->id, 'cil-trash', 'Hapus', 'Anda yakin akan menghapus jenis output ini?') !!}
    @endcan
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-6">

            <div class="card">
                <div class="card-header font-weight-bold">
                    Detail Output
                </div>

                <div class="card-body">

                    <!-- Static Field for Kode -->
                    <div class="form-group">
                        <div class="form-label">Kode</div>
                        <div>{{ $output->code }}</div>
                    </div>

                    <!-- Static Field for Jenis Usulan -->
                    <div class="form-group">
                        <div class="form-label">Jenis Usulan</div>
                        <div>{{ $output->jenis_usulan ? App\Usulan::JENIS_USULAN[$output->jenis_usulan] : "" }}</div>
                    </div>

                    <!-- Static Field for Luaran -->
                    <div class="form-group">
                        <div class="form-label">Luaran</div>
                        <div>{{ $output->luaran }}</div>
                    </div>

                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    {{ trans('global.relatedData') }}
                </div>
                <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="#output_output_skemas" role="tab" data-toggle="tab">
                            {{ trans('cruds.outputSkema.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="output_output_skemas">
                        @includeIf('admin.outputs.relationships.outputOutputSkemas', ['outputSkemas' => $output->outputOutputSkemas])
                    </div>
                </div>
            </div>

        </div>
    </div>



@endsection
