@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('user.home'),
        'Fokus' => route('prn-fokus.index'),
        'Index' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('prn_fokus_manage')
        {!! cui_toolbar_btn(route('prn-fokus.create'), 'icon-plus', 'Add Fokus' ) !!}
    @endcan
@stop
@section('content')
<div class="card">
    <div class="card-header font-weight-bold">
        List Fokus
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Prodi">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            ID
                        </th>
                        <th>
                            {{ trans('cruds.prodi.fields.nama') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prnFokus as $key => $fokus)
                        <tr data-entry-id="{{ $fokus->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $fokus->id ?? '' }}
                            </td>
                            <td>
                                {{ $fokus->nama ?? '' }}
                            </td>
                            <td>
                                @can('prn_fokus_manage')
                                    {!! cui_btn_edit(route('prn-fokus.edit', [$fokus->id])) !!}
                                    {!! cui_btn_delete(route('prn-fokus.destroy', [$fokus->id]), "Anda yakin akan menghapus data Fokus ini?") !!}
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
@can('prn_fokus_manage')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('prn-fokus.massDestroy') }}",
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
  $('.datatable-Prodi:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
