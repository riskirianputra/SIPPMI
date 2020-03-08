@can('penelitian_biaya_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.penelitian-biayas.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.penelitianBiaya.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.penelitianBiaya.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-PenelitianBiaya">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.penelitianBiaya.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.penelitianBiaya.fields.biaya_skema') }}
                        </th>
                        <th>
                            {{ trans('cruds.penelitianBiaya.fields.penelitian') }}
                        </th>
                        <th>
                            {{ trans('cruds.penelitianBiaya.fields.jumlah') }}
                        </th>
                        <th>
                            {{ trans('cruds.penelitianBiaya.fields.jumlah_final') }}
                        </th>
                        <th>
                            {{ trans('cruds.penelitianBiaya.fields.satuan') }}
                        </th>
                        <th>
                            {{ trans('cruds.penelitianBiaya.fields.harga_satuan') }}
                        </th>
                        <th>
                            {{ trans('cruds.penelitianBiaya.fields.harga_satuan_final') }}
                        </th>
                        <th>
                            {{ trans('cruds.penelitianBiaya.fields.justifikasi') }}
                        </th>
                        <th>
                            {{ trans('cruds.penelitianBiaya.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penelitianBiayas as $key => $penelitianBiaya)
                        <tr data-entry-id="{{ $penelitianBiaya->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $penelitianBiaya->id ?? '' }}
                            </td>
                            <td>
                                {{ $penelitianBiaya->biaya_skema->persen_max ?? '' }}
                            </td>
                            <td>
                                {{ $penelitianBiaya->penelitian->judul ?? '' }}
                            </td>
                            <td>
                                {{ $penelitianBiaya->jumlah ?? '' }}
                            </td>
                            <td>
                                {{ $penelitianBiaya->jumlah_final ?? '' }}
                            </td>
                            <td>
                                {{ $penelitianBiaya->satuan ?? '' }}
                            </td>
                            <td>
                                {{ $penelitianBiaya->harga_satuan ?? '' }}
                            </td>
                            <td>
                                {{ $penelitianBiaya->harga_satuan_final ?? '' }}
                            </td>
                            <td>
                                {{ $penelitianBiaya->justifikasi ?? '' }}
                            </td>
                            <td>
                                {{ $penelitianBiaya->status ?? '' }}
                            </td>
                            <td>
                                @can('penelitian_biaya_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.penelitian-biayas.show', $penelitianBiaya->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('penelitian_biaya_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.penelitian-biayas.edit', $penelitianBiaya->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('penelitian_biaya_delete')
                                    <form action="{{ route('admin.penelitian-biayas.destroy', $penelitianBiaya->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('penelitian_biaya_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.penelitian-biayas.massDestroy') }}",
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
  $('.datatable-PenelitianBiaya:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection