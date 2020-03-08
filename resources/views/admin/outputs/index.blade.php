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
        {!! cui_toolbar_btn(route('admin.ref-skemas.index'), 'icon-list', trans('global.list').' '.trans('cruds.refSkema.title_singular') ) !!}
    @endcan
    @can('output_manage')
        {!! cui_toolbar_btn(route('admin.outputs.create'), 'icon-plus', trans('global.add').' '.trans('cruds.output.title_singular') ) !!}
    @endcan
@stop
@section('content')
<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('cruds.output.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Output">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
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
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($outputs as $key => $output)
                        <tr data-entry-id="{{ $output->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $output->id ?? '' }}
                            </td>
                            <td>
                                {{ $output->code ?? '' }}
                            </td>
                            <td>
                                {{ $output->jenis_usulan->nama ?? '' }}
                            </td>
                            <td>
                                {{ $output->luaran ?? '' }}
                            </td>
                            <td>
                                @can('output_view')
                                    {!! cui_btn_view(route('admin.outputs.show', [$output->id])) !!}
                                @endcan

                                @can('ref_skema_manage')
                                    {!! cui_btn_edit(route('admin.outputs.edit', [$output->id])) !!}
                                    {!! cui_btn_delete(route('admin.outputs.destroy', [$output->id]), "Anda yakin akan menghapus data output ini?") !!}
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
