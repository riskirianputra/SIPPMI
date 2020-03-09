@can('rip_tahapan_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.rip-tahapans.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.ripTahapan.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.ripTahapan.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-RipTahapan">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.ripTahapan.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.ripTahapan.fields.sub_topik') }}
                        </th>
                        <th>
                            {{ trans('cruds.ripTahapan.fields.tahun') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ripTahapans as $key => $ripTahapan)
                        <tr data-entry-id="{{ $ripTahapan->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $ripTahapan->id ?? '' }}
                            </td>
                            <td>
                                {{ $ripTahapan->sub_topik->nama ?? '' }}
                            </td>
                            <td>
                                {{ $ripTahapan->tahun ?? '' }}
                            </td>
                            <td>
                                @can('rip_tahapan_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.rip-tahapans.show', $ripTahapan->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('rip_tahapan_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.rip-tahapans.edit', $ripTahapan->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('rip_tahapan_delete')
                                    <form action="{{ route('admin.rip-tahapans.destroy', $ripTahapan->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('rip_tahapan_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.rip-tahapans.massDestroy') }}",
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
  $('.datatable-RipTahapan:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection