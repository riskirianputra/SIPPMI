@extends('layouts.admin')
@section('content')
@can('jenis_usulan_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.jenis-usulans.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.jenisUsulan.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('cruds.jenisUsulan.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-JenisUsulan">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.jenisUsulan.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.jenisUsulan.fields.kode') }}
                        </th>
                        <th>
                            {{ trans('cruds.jenisUsulan.fields.nama') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jenisUsulans as $key => $jenisUsulan)
                        <tr data-entry-id="{{ $jenisUsulan->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $jenisUsulan->id ?? '' }}
                            </td>
                            <td>
                                {{ $jenisUsulan->kode ?? '' }}
                            </td>
                            <td>
                                {{ $jenisUsulan->nama ?? '' }}
                            </td>
                            <td>
                                @can('jenis_usulan_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.jenis-usulans.show', $jenisUsulan->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('jenis_usulan_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.jenis-usulans.edit', $jenisUsulan->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('jenis_usulan_delete')
                                    <form action="{{ route('admin.jenis-usulans.destroy', $jenisUsulan->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('jenis_usulan_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.jenis-usulans.massDestroy') }}",
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
  $('.datatable-JenisUsulan:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
