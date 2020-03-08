@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Staff' => route('admin.staff.index'),
        'Index' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('staff_manage')
        {!! cui_toolbar_btn(route('admin.staff.create'), 'icon-plus', trans('global.add').' '.trans('cruds.staff.title_singular') ) !!}
    @endcan
@stop
@section('content')
<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('cruds.staff.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Staff">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.staff.fields.nama') }}
                        </th>
                        <th>
                            {{ trans('cruds.staff.fields.nip') }}
                        </th>
                        <th>
                            {{ trans('cruds.staff.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.staff.fields.telepon') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($staff as $key => $staff)
                        <tr data-entry-id="{{ $staff->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $staff->nama ?? '' }}
                            </td>
                            <td>
                                {{ $staff->nip ?? '' }}
                            </td>
                            <td>
                                {{ $staff->email ?? '' }}
                            </td>
                            <td>
                                {{ $staff->telepon ?? '' }}
                            </td>
                            <td>
                                @can('staff_view')
                                    {!! cui_btn_view(route('admin.staff.show', [$staff->id])) !!}
                                @endcan

                                @can('staff_manage')
                                    {!! cui_btn_edit(route('admin.staff.edit', [$staff->id])) !!}
                                    {!! cui_btn_delete(route('admin.staff.destroy', [$staff->id]), "Anda yakin akan menghapus data staff ini?") !!}
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
@can('staff_manage')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.staff.massDestroy') }}",
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
  $('.datatable-Staff:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
