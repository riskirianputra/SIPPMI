@can('dosen_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.dosens.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.dosen.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.dosen.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Dosen">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.dosen.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.dosen.fields.nama') }}
                        </th>
                        <th>
                            {{ trans('cruds.dosen.fields.nip') }}
                        </th>
                        <th>
                            {{ trans('cruds.dosen.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.dosen.fields.prodi') }}
                        </th>
                        <th>
                            {{ trans('cruds.prodi.fields.kode_dikti') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dosens as $key => $dosen)
                        <tr data-entry-id="{{ $dosen->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $dosen->id ?? '' }}
                            </td>
                            <td>
                                {{ $dosen->nama ?? '' }}
                            </td>
                            <td>
                                {{ $dosen->nip ?? '' }}
                            </td>
                            <td>
                                {{ $dosen->email ?? '' }}
                            </td>
                            <td>
                                {{ $dosen->prodi->nama ?? '' }}
                            </td>
                            <td>
                                {{ $dosen->prodi->kode_dikti ?? '' }}
                            </td>
                            <td>
                                @can('dosen_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.dosens.show', $dosen->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('dosen_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.dosens.edit', $dosen->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('dosen_delete')
                                    <form action="{{ route('admin.dosens.destroy', $dosen->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('dosen_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.dosens.massDestroy') }}",
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
  $('.datatable-Dosen:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection