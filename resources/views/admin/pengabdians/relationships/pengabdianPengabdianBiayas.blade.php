@can('pengabdian_biaya_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.pengabdian-biayas.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.pengabdianBiaya.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.pengabdianBiaya.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-PengabdianBiaya">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.pengabdianBiaya.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.pengabdianBiaya.fields.biaya_skema') }}
                        </th>
                        <th>
                            {{ trans('cruds.pengabdianBiaya.fields.pengabdian') }}
                        </th>
                        <th>
                            {{ trans('cruds.pengabdianBiaya.fields.jumlah') }}
                        </th>
                        <th>
                            {{ trans('cruds.pengabdianBiaya.fields.jumlah_final') }}
                        </th>
                        <th>
                            {{ trans('cruds.pengabdianBiaya.fields.satuan') }}
                        </th>
                        <th>
                            {{ trans('cruds.pengabdianBiaya.fields.harga_satuan') }}
                        </th>
                        <th>
                            {{ trans('cruds.pengabdianBiaya.fields.harga_satuan_final') }}
                        </th>
                        <th>
                            {{ trans('cruds.pengabdianBiaya.fields.justifikasi') }}
                        </th>
                        <th>
                            {{ trans('cruds.pengabdianBiaya.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengabdianBiayas as $key => $pengabdianBiaya)
                        <tr data-entry-id="{{ $pengabdianBiaya->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $pengabdianBiaya->id ?? '' }}
                            </td>
                            <td>
                                {{ $pengabdianBiaya->biaya_skema->persen_max ?? '' }}
                            </td>
                            <td>
                                {{ $pengabdianBiaya->pengabdian->judul ?? '' }}
                            </td>
                            <td>
                                {{ $pengabdianBiaya->jumlah ?? '' }}
                            </td>
                            <td>
                                {{ $pengabdianBiaya->jumlah_final ?? '' }}
                            </td>
                            <td>
                                {{ $pengabdianBiaya->satuan ?? '' }}
                            </td>
                            <td>
                                {{ $pengabdianBiaya->harga_satuan ?? '' }}
                            </td>
                            <td>
                                {{ $pengabdianBiaya->harga_satuan_final ?? '' }}
                            </td>
                            <td>
                                {{ $pengabdianBiaya->justifikasi ?? '' }}
                            </td>
                            <td>
                                {{ $pengabdianBiaya->status ?? '' }}
                            </td>
                            <td>
                                @can('pengabdian_biaya_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.pengabdian-biayas.show', $pengabdianBiaya->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('pengabdian_biaya_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.pengabdian-biayas.edit', $pengabdianBiaya->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('pengabdian_biaya_delete')
                                    <form action="{{ route('admin.pengabdian-biayas.destroy', $pengabdianBiaya->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('pengabdian_biaya_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.pengabdian-biayas.massDestroy') }}",
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
  $('.datatable-PengabdianBiaya:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection