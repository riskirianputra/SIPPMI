@can('ref_skema_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.ref-skemas.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.refSkema.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.refSkema.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-RefSkema">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.refSkema.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.refSkema.fields.jenis_usulan') }}
                        </th>
                        <th>
                            {{ trans('cruds.refSkema.fields.nama') }}
                        </th>
                        <th>
                            {{ trans('cruds.refSkema.fields.jangka_waktu') }}
                        </th>
                        <th>
                            {{ trans('cruds.refSkema.fields.biaya_min') }}
                        </th>
                        <th>
                            {{ trans('cruds.refSkema.fields.biaya_maksimal') }}
                        </th>
                        <th>
                            {{ trans('cruds.refSkema.fields.sumber_dana') }}
                        </th>
                        <th>
                            {{ trans('cruds.refSkema.fields.anggota_min') }}
                        </th>
                        <th>
                            {{ trans('cruds.refSkema.fields.anggota_max') }}
                        </th>
                        <th>
                            {{ trans('cruds.refSkema.fields.jabatan_ketua_min') }}
                        </th>
                        <th>
                            {{ trans('cruds.refSkema.fields.jabatan_ketua_max') }}
                        </th>
                        <th>
                            {{ trans('cruds.refSkema.fields.jabatan_anggota_min') }}
                        </th>
                        <th>
                            {{ trans('cruds.refSkema.fields.jabatan_anggota_max') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($refSkemas as $key => $refSkema)
                        <tr data-entry-id="{{ $refSkema->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $refSkema->id ?? '' }}
                            </td>
                            <td>
                                {{ $refSkema->jenis_usulan->nama ?? '' }}
                            </td>
                            <td>
                                {{ $refSkema->nama ?? '' }}
                            </td>
                            <td>
                                {{ $refSkema->jangka_waktu ?? '' }}
                            </td>
                            <td>
                                {{ $refSkema->biaya_min ?? '' }}
                            </td>
                            <td>
                                {{ $refSkema->biaya_maksimal ?? '' }}
                            </td>
                            <td>
                                {{ $refSkema->sumber_dana ?? '' }}
                            </td>
                            <td>
                                {{ $refSkema->anggota_min ?? '' }}
                            </td>
                            <td>
                                {{ $refSkema->anggota_max ?? '' }}
                            </td>
                            <td>
                                {{ $refSkema->jabatan_ketua_min ?? '' }}
                            </td>
                            <td>
                                {{ $refSkema->jabatan_ketua_max ?? '' }}
                            </td>
                            <td>
                                {{ $refSkema->jabatan_anggota_min ?? '' }}
                            </td>
                            <td>
                                {{ $refSkema->jabatan_anggota_max ?? '' }}
                            </td>
                            <td>
                                @can('ref_skema_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.ref-skemas.show', $refSkema->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('ref_skema_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.ref-skemas.edit', $refSkema->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('ref_skema_delete')
                                    <form action="{{ route('admin.ref-skemas.destroy', $refSkema->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('ref_skema_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.ref-skemas.massDestroy') }}",
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
  $('.datatable-RefSkema:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection