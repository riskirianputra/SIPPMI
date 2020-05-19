@can('pengabdian_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.pengabdians.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.pengabdian.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.pengabdian.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Pengabdian">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.pengabdian.fields.judul') }}
                        </th>
                        <th>
                            {{ trans('cruds.pengabdian.fields.mitra_pengabdian') }}
                        </th>
                        <th>
                            {{ trans('cruds.pengabdian.fields.skema') }}
                        </th>
                        <th>
                            {{ trans('cruds.pengabdian.fields.prodi') }}
                        </th>
                        <th>
                            {{ trans('cruds.pengabdian.fields.status_pengabdian') }}
                        </th>
                        <th>
                            {{ trans('cruds.pengabdian.fields.biaya') }}
                        </th>
                        <th>
                            {{ trans('cruds.pengabdian.fields.file_proposal') }}
                        </th>
                        <th>
                            {{ trans('cruds.pengabdian.fields.file_profile_pengabdian') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengabdians as $key => $pengabdian)
                        <tr data-entry-id="{{ $pengabdian->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $pengabdian->judul ?? '' }}
                            </td>
                            <td>
                                {{ $pengabdian->mitra_pengabdian ?? '' }}
                            </td>
                            <td>
                                {{ $pengabdian->skema->nama ?? '' }}
                            </td>
                            <td>
                                {{ $pengabdian->prodi->nama ?? '' }}
                            </td>
                            <td>
                                {{ $pengabdian->status_pengabdian ?? '' }}
                            </td>
                            <td>
                                {{ $pengabdian->biaya ?? '' }}
                            </td>
                            <td>
                                @if($pengabdian->file_proposal)
                                    <a href="{{ $pengabdian->file_proposal->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                            <td>
                                @if($pengabdian->file_profile_pengabdian)
                                    <a href="{{ $pengabdian->file_profile_pengabdian->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                            <td>
                                @can('pengabdian_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.pengabdians.show', $pengabdian->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('pengabdian_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.pengabdians.edit', $pengabdian->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('pengabdian_delete')
                                    <form action="{{ route('admin.pengabdians.destroy', $pengabdian->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('pengabdian_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.pengabdians.massDestroy') }}",
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
  $('.datatable-Pengabdian:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection