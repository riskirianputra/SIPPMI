<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('cruds.outputSkema.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.outputSkema.fields.output') }}
                        </th>
                        <th>
                            {{ trans('cruds.outputSkema.fields.required') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($outputSkemas as $key => $outputSkema)
                        <tr data-entry-id="{{ $outputSkema->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $outputSkema->output->luaran ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $outputSkema->required ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $outputSkema->required ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('output_skema_view')
                                    {!! cui_btn_view(route('admin.output-skemas.show', [$refSkema_id,$outputSkema->id])) !!}
                                @endcan

                                @can('output_skema_manage')
                                    {!! cui_btn_edit(route('admin.output-skemas.edit', [$refSkema_id,$outputSkema->id])) !!}
                                    {!! cui_btn_delete(route('admin.output-skemas.destroy', [$refSkema_id,$outputSkema->id]), "Anda yakin akan menghapus data Output pada Skema ini?") !!}
                                @endcan
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer">
        @can('output_skema_manage')
            <div style="margin-bottom: 10px;" class="row">
                <div class="col-lg-12">
                    <a class="btn btn-success" href="{{ route("admin.output-skemas.create",[$refSkema_id]) }}">
                        {{ trans('global.add') }} {{ trans('cruds.outputSkema.title_singular') }}
                    </a>
                </div>
            </div>
        @endcan
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('output_skema_manage')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.output-skemas.massDestroy',[$refSkema_id]) }}",
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
    pageLength: 10,
  });
  $('.datatable-OutputSkema:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
