@can('biaya_skema_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.biaya-skemas.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.biayaSkema.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.biayaSkema.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-BiayaSkema">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.biayaSkema.fields.biaya') }}
                        </th>
                        <th>
                            {{ trans('cruds.biayaSkema.fields.persen_max') }}
                        </th>
                        <th>
                            {{ trans('cruds.biayaSkema.fields.persen_min') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($biayaSkemas as $key => $biayaSkema)
                        <tr data-entry-id="{{ $biayaSkema->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $biayaSkema->biaya->nama ?? '' }}
                            </td>
                            <td>
                                {{ $biayaSkema->persen_max ?? '' }}
                            </td>
                            <td>
                                {{ $biayaSkema->persen_min ?? '' }}
                            </td>
                            <td>
                                @can('biaya_skema_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.biaya-skemas.show', $biayaSkema->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('biaya_skema_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.biaya-skemas.edit', $biayaSkema->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('biaya_skema_delete')
                                    <form action="{{ route('admin.biaya-skemas.destroy', $biayaSkema->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('biaya_skema_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.biaya-skemas.massDestroy') }}",
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
  $('.datatable-BiayaSkema:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection