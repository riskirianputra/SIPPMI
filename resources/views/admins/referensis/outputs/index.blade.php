@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Skema' => route('admin.ref-skemas.index'),
        'Output' => route('admin.outputs.index'),
        'Index' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('ref_skema_manage')
        {!! cui_toolbar_btn(route('admin.ref-skemas.index'), 'cil-list', 'List Skema')!!}
    @endcan
    @can('output_manage')
        {!! cui_toolbar_btn(route('admin.outputs.create'), 'cil-plus', 'Tambah Output') !!}
    @endcan
@stop
@section('content')
<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('cruds.output.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-outline table-striped table-hover datatable datatable-Output" style="width: 100%">
                <thead class="thead-light">
                    <tr>
                        <th>
                            {{ trans('cruds.output.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.output.fields.code') }}
                        </th>
                        <th>
                            {{ trans('cruds.output.fields.jenis_usulan') }}
                        </th>
                        <th>
                            {{ trans('cruds.output.fields.luaran') }}
                        </th>
                        <th class="text-center">
                            <i class="cil-options"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($outputs as $key => $output)
                        <tr data-entry-id="{{ $output->id }}">
                            <td>
                                {{ $output->id ?? '' }}
                            </td>
                            <td>
                                {{ $output->code ?? '' }}
                            </td>
                            <td>
                                {{ $output->jenis_usulan ? App\Usulan::JENIS_USULAN[$output->jenis_usulan] : '' }}
                            </td>
                            <td>
                                {{ $output->luaran ?? '' }}
                            </td>
                            <td class="text-center">
                                @can('output_view')
                                    {!! cui()->btn_view(route('admin.outputs.show', [$output->id])) !!}
                                @endcan

                                @can('ref_skema_manage')
                                    {!! cui()->btn_edit(route('admin.outputs.edit', [$output->id])) !!}
                                    {!! cui()->btn_delete(route('admin.outputs.destroy', [$output->id]), "Anda yakin akan menghapus data output ini?") !!}
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
@can('output_manage')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.outputs.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Output:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
