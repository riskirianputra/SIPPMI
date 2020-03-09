@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Sub Topik' => route('admin.rip-sub-topiks.index'),
        'Index' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('rip_sub_topik_manage')
        {!! cui_toolbar_btn(route('admin.rip-sub-topiks.create'), 'icon-plus', trans('global.add').' '.trans('cruds.ripSubTopik.title_singular') ) !!}
    @endcan
@stop
@section('content')
<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('cruds.ripSubTopik.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-RipSubTopik">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.ripSubTopik.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.ripSubTopik.fields.topik') }}
                        </th>
                        <th>
                            {{ trans('cruds.ripSubTopik.fields.nama') }}
                        </th>
                        <th>
                            {{ trans('cruds.ripSubTopik.fields.luaran') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ripSubTopiks as $key => $ripSubTopik)
                        <tr data-entry-id="{{ $ripSubTopik->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $ripSubTopik->id ?? '' }}
                            </td>
                            <td>
                                {{ $ripSubTopik->topik->nama ?? '' }}
                            </td>
                            <td>
                                {{ $ripSubTopik->nama ?? '' }}
                            </td>
                            <td>
                                {{ $ripSubTopik->luaran ?? '' }}
                            </td>
                            <td>
                                @can('rip_sub_topik_view')
                                    {!! cui_btn_view(route('admin.rip-sub-topiks.show', [$ripSubTopik->id])) !!}
                                @endcan

                                @can('rip_sub_topik_manage')
                                    {!! cui_btn_edit(route('admin.rip-sub-topiks.edit', [$ripSubTopik->id])) !!}
                                    {!! cui_btn_delete(route('admin.rip-sub-topiks.destroy', [$ripSubTopik->id]), "Anda yakin akan menghapus data Sub Topik ini?") !!}
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
@can('rip_sub_topik_manage')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.rip-sub-topiks.massDestroy') }}",
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
  $('.datatable-RipSubTopik:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
