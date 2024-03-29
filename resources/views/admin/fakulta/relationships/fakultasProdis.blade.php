@can('prodi_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.prodis.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.prodi.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.prodi.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Prodi">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.prodi.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.prodi.fields.nama') }}
                        </th>
                        <th>
                            {{ trans('cruds.prodi.fields.fakultas') }}
                        </th>
                        <th>
                            {{ trans('cruds.fakultum.fields.singkatan') }}
                        </th>
                        <th>
                            {{ trans('cruds.prodi.fields.kode') }}
                        </th>
                        <th>
                            {{ trans('cruds.prodi.fields.kode_dikti') }}
                        </th>
                        <th>
                            {{ trans('cruds.prodi.fields.akreditasi') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prodis as $key => $prodi)
                        <tr data-entry-id="{{ $prodi->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $prodi->id ?? '' }}
                            </td>
                            <td>
                                {{ $prodi->nama ?? '' }}
                            </td>
                            <td>
                                {{ $prodi->fakultas->nama ?? '' }}
                            </td>
                            <td>
                                {{ $prodi->fakultas->singkatan ?? '' }}
                            </td>
                            <td>
                                {{ $prodi->kode ?? '' }}
                            </td>
                            <td>
                                {{ $prodi->kode_dikti ?? '' }}
                            </td>
                            <td>
                                {{ $prodi->akreditasi ?? '' }}
                            </td>
                            <td>
                                @can('prodi_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.prodis.show', $prodi->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('prodi_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.prodis.edit', $prodi->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('prodi_delete')
                                    <form action="{{ route('admin.prodis.destroy', $prodi->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('prodi_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.prodis.massDestroy') }}",
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
  $('.datatable-Prodi:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection