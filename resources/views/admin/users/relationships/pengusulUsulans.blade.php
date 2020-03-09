@can('usulan_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.usulans.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.usulan.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.usulan.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Usulan">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.usulan.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.usulan.fields.pengusul') }}
                        </th>
                        <th>
                            {{ trans('cruds.usulan.fields.status_usulan') }}
                        </th>
                        <th>
                            {{ trans('cruds.usulan.fields.jenis_usulan') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usulans as $key => $usulan)
                        <tr data-entry-id="{{ $usulan->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $usulan->id ?? '' }}
                            </td>
                            <td>
                                {{ $usulan->pengusul->name ?? '' }}
                            </td>
                            <td>
                                {{ App\Usulan::STATUS_USULAN_SELECT[$usulan->status_usulan] ?? '' }}
                            </td>
                            <td>
                                {{ App\Usulan::JENIS_USULAN_SELECT[$usulan->jenis_usulan] ?? '' }}
                            </td>
                            <td>
                                @can('usulan_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.usulans.show', $usulan->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('usulan_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.usulans.edit', $usulan->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('usulan_delete')
                                    <form action="{{ route('admin.usulans.destroy', $usulan->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('usulan_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.usulans.massDestroy') }}",
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
  $('.datatable-Usulan:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection