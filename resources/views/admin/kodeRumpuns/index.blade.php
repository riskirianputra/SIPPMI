@extends('layouts.admin')

@section('breadcrumb')
    {!! cui()->breadcrumb([
        'Home' => url('home'),
        'Kode Rumpun Ilmu' => '#'
    ]) !!}
@endsection

@section('toolbar')
    @can('kode_rumpun_manage')
        {!! cui()->toolbar_btn(route('admin.kode-rumpuns.create'), 'cil-plus', 'Tambah Rumpun Ilmu') !!}
    @endcan
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('cruds.kodeRumpun.title_singular') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-KodeRumpun" style="width: 100%">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th class="text-center">
                            {{ trans('cruds.kodeRumpun.fields.kode') }}
                        </th>
                        <th class="text-center">
                            {{ trans('cruds.kodeRumpun.fields.rumpun_ilmu') }}
                        </th>
                        <th class="text-center">
                            Level
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kodeRumpuns as $key => $kodeRumpun)
                        <tr data-entry-id="{{ $kodeRumpun->id }}" class="text-center">
                            <td>

                            </td>
                            <td>
                                {{ optional($kodeRumpun)->kode }}
                            </td>
                            <td class="text-left">
                                {{ optional($kodeRumpun)->rumpun_ilmu }}
                            </td>
                            <td class="text-center">
                                {{ optional($kodeRumpun)->level }}
                            </td>
                            <td>
                                @can('kode_rumpun_view')
                                    {!! cui()->btn_view(route('admin.kode-rumpuns.show', $kodeRumpun->id)) !!}
                                @endcan

                                @can('kode_rumpun_manage')
                                    {!! cui()->btn_edit(route('admin.kode-rumpuns.edit', $kodeRumpun->id)) !!}
                                @endcan

                                @can('kode_rumpun_manage')
                                    {!! cui()->btn_delete(route('admin.kode-rumpuns.destroy', $kodeRumpun->id), 'Anda yakin menghapus data ini?') !!}
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
@can('kode_rumpun_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.kode-rumpuns.massDestroy') }}",
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
  $('.datatable-KodeRumpun:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
