@can('output_skema_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.output-skemas.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.outputSkema.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.outputSkema.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-OutputSkema">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.outputSkema.fields.output') }}
                        </th>
                        <th>
                            {{ trans('cruds.outputSkema.fields.skema') }}
                        </th>
                        <th>
                            {{ trans('cruds.outputSkema.fields.field') }}
                        </th>
                        <th>
                            {{ trans('cruds.outputSkema.fields.mime') }}
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
                                {{ $outputSkema->skema->nama ?? '' }}
                            </td>
                            <td>
                                {{ $outputSkema->field ?? '' }}
                            </td>
                            <td>
                                {{ $outputSkema->mime ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $outputSkema->required ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $outputSkema->required ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('output_skema_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.output-skemas.show', $outputSkema->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('output_skema_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.output-skemas.edit', $outputSkema->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('output_skema_delete')
                                    <form action="{{ route('admin.output-skemas.destroy', $outputSkema->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('output_skema_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.output-skemas.massDestroy') }}",
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
  $('.datatable-OutputSkema:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection