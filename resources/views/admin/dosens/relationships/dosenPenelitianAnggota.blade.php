@can('penelitian_anggotum_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.penelitian-anggota.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.penelitianAnggotum.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.penelitianAnggotum.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-PenelitianAnggotum">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.penelitianAnggotum.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.penelitianAnggotum.fields.dosen') }}
                        </th>
                        <th>
                            {{ trans('cruds.dosen.fields.nip') }}
                        </th>
                        <th>
                            {{ trans('cruds.penelitianAnggotum.fields.penelitian') }}
                        </th>
                        <th>
                            {{ trans('cruds.penelitianAnggotum.fields.jabatan') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penelitianAnggota as $key => $penelitianAnggotum)
                        <tr data-entry-id="{{ $penelitianAnggotum->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $penelitianAnggotum->id ?? '' }}
                            </td>
                            <td>
                                {{ $penelitianAnggotum->dosen->nama ?? '' }}
                            </td>
                            <td>
                                {{ $penelitianAnggotum->dosen->nip ?? '' }}
                            </td>
                            <td>
                                {{ $penelitianAnggotum->penelitian->judul ?? '' }}
                            </td>
                            <td>
                                {{ App\PenelitianAnggotum::JABATAN_SELECT[$penelitianAnggotum->jabatan] ?? '' }}
                            </td>
                            <td>
                                @can('penelitian_anggotum_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.penelitian-anggota.show', $penelitianAnggotum->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('penelitian_anggotum_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.penelitian-anggota.edit', $penelitianAnggotum->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('penelitian_anggotum_delete')
                                    <form action="{{ route('admin.penelitian-anggota.destroy', $penelitianAnggotum->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('penelitian_anggotum_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.penelitian-anggota.massDestroy') }}",
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
  $('.datatable-PenelitianAnggotum:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection