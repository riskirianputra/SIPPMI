@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Tahapan' => route('admin.rip-tahapans.index'),
        'Index' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('rip_tahapan_manage')
        {!! cui_toolbar_btn(route('admin.rip-tahapans.create'), 'icon-plus', trans('global.add').' '.trans('cruds.ripTahapan.title_singular') ) !!}
    @endcan
@stop
@section('content')
<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('cruds.ripTahapan.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-RipTahapan">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.ripTahapan.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.ripTahapan.fields.sub_topik') }}
                        </th>
                        <th>
                            {{ trans('cruds.ripTahapan.fields.tahun') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ripTahapans as $key => $ripTahapan)
                        <tr data-entry-id="{{ $ripTahapan->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $ripTahapan->id ?? '' }}
                            </td>
                            <td>
                                {{ $ripTahapan->sub_topik->nama ?? '' }}
                            </td>
                            <td>
                                {{ $ripTahapan->tahun ?? '' }}
                            </td>
                            <td>
                                @can('rip_tahapan_view')
                                    {!! cui_btn_view(route('admin.rip-tahapans.show', [$ripTahapan->id])) !!}
                                @endcan

                                @can('rip_tahapan_manage')
                                    {!! cui_btn_edit(route('admin.rip-tahapans.edit', [$ripTahapan->id])) !!}
                                    {!! cui_btn_delete(route('admin.rip-tahapans.destroy', [$ripTahapan->id]), "Anda yakin akan menghapus data Tahapan ini?") !!}
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
@can('rip_tahapan_manage')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.rip-tahapans.massDestroy') }}",
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
  $('.datatable-RipTahapan:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
