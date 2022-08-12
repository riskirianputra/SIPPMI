@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Skema' => route('admin.ref-skemas.index'),
        'Index' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('output_view')
        {!! cui()->toolbar_btn(route('admin.outputs.index'), 'cil-list', 'Output Skema') !!}
    @endcan
    @can('ref_skema_manage')
        {!! cui()->toolbar_btn(route('admin.ref-skemas.create'), 'cil-plus', 'Tambah Skema') !!}
    @endcan
@stop
@section('content')
    <div class="card">
        <div class="card-header font-weight-bold">
            {{ trans('cruds.refSkema.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-outline table-striped table-hover datatable datatable-RefSkema"
                       style="width: 100%">
                    <thead class="thead-light">
                    <tr>
                        <th style="width: 80px">
                            Jenis
                        </th>
                        <th>
                            Nama Skema
                        </th>
                        <th style="width: 80px">
                            Jangka Waktu (thn)
                        </th>
                        <th style="width: 100px">
                            Biaya Maksimal
                        </th>
                        <th>
                            Sumber Dana
                        </th>
                        <th style="width: 80px" class="text-center">
                            <i class="cil-options"></i>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($refSkemas as $key => $refSkema)
                        <tr data-entry-id="{{ $refSkema->id }}" >
                            <td>
                                {{ App\RefSkema::JENIS_USULAN_SELECT[$refSkema->jenis_usulan] ?? '' }}
                            </td>
                            <td>
                                {{ $refSkema->nama ?? '' }}
                            </td>
                            <td>
                                {{ $refSkema->jangka_waktu ?? '' }}
                            </td>
                            <td>
                                {{ $refSkema->biaya_maksimal ? format_rupiah($refSkema->biaya_maksimal) : '' }}
                            </td>
                            <td>
                                {{ $refSkema->sumber_dana ?? '' }}
                            </td>
                            <td class="text-center">
                                @can('ref_skema_view')
                                    {!! cui()->btn_view(route('admin.ref-skemas.show', [$refSkema->id])) !!}
                                @endcan

                                @can('ref_skema_manage')
                                    {!! cui()->btn_edit(route('admin.ref-skemas.edit', [$refSkema->id])) !!}
                                    {!! cui()->btn_delete(route('admin.ref-skemas.destroy', [$refSkema->id]), "Anda yakin akan menghapus data Skema ini?") !!}
                                @endcan
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



@endsection
@section('scripts')
    @parent
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

            $.extend(true, $.fn.dataTable.defaults, {
                order: [[2, 'desc']],
                pageLength: 100,
            });
            $('.datatable-RefSkema:not(.ajaxTable)').DataTable({buttons: dtButtons})
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })

    </script>
@endsection
