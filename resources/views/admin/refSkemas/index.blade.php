@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Skema' => route('admin.ref-skemas.index'),
        'Index' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('output_view')
        {!! cui_toolbar_btn(route('admin.outputs.index'), 'icon-plus', trans('cruds.output.title_singular') ) !!}
    @endcan
    @can('ref_skema_manage')
        {!! cui_toolbar_btn(route('admin.ref-skemas.create'), 'icon-plus', trans('global.add').' '.trans('cruds.refSkema.title_singular') ) !!}
    @endcan
@stop
@section('content')
<div class="card">
    <div class="card-header font-weight-bold">
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
                            {{ trans('cruds.refSkema.fields.jenis_usulan') }}
                        </th>
                        <th>
                            {{ trans('cruds.refSkema.fields.nama') }}
                        </th>
                        <th>
                            {{ trans('cruds.refSkema.fields.jangka_waktu') }}
                        </th>
                        <th>
                            {{ trans('cruds.refSkema.fields.biaya_maksimal') }}
                        </th>
                        <th>
                            {{ trans('cruds.refSkema.fields.sumber_dana') }}
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
                                {{ App\RefSkema::JENIS_USULAN_SELECT[$refSkema->jenis_usulan] ?? '' }}
                            </td>
                            <td>
                                {{ $refSkema->nama ?? '' }}
                            </td>
                            <td>
                                {{ $refSkema->jangka_waktu ?? '' }}
                            </td>
                            <td>
                                {{ $refSkema->biaya_maksimal ?? '' }}
                            </td>
                            <td>
                                {{ $refSkema->sumber_dana ?? '' }}
                            </td>
                            <td>
                                @can('ref_skema_view')
                                    {!! cui_btn_view(route('admin.ref-skemas.show', [$refSkema->id])) !!}
                                @endcan

                                @can('ref_skema_manage')
                                    {!! cui_btn_edit(route('admin.ref-skemas.edit', [$refSkema->id])) !!}
                                    {!! cui_btn_delete(route('admin.ref-skemas.destroy', [$refSkema->id]), "Anda yakin akan menghapus data Skema ini?") !!}
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
@can('ref_skema_manage')
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
    order: [[ 2, 'desc' ]],
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
