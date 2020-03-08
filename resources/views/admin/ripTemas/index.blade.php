@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Tema' => route('admin.rip-temas.index'),
        'Index' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('rip_tema_manage')
        {!! cui_toolbar_btn(route('admin.rip-temas.create'), 'icon-plus', trans('global.add').' '.trans('cruds.ripTema.title_singular') ) !!}
    @endcan
@stop
@section('content')
<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('cruds.ripTema.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-RipTema">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.ripTema.fields.periode') }}
                        </th>
                        <th>
                            {{ trans('cruds.ripTema.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.ripTema.fields.nama') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ripTemas as $key => $ripTema)
                        <tr data-entry-id="{{ $ripTema->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $ripTema->periode ?? '' }}
                            </td>
                            <td>
                                {{ $ripTema->status ?? '' }}
                            </td>
                            <td>
                                {{ $ripTema->nama ?? '' }}
                            </td>
                            <td>
                                @can('rip_tema_view')
                                    {!! cui_btn_view(route('admin.rip-temas.show', [$ripTema->id])) !!}
                                @endcan

                                @can('rip_tema_manage')
                                    {!! cui_btn_edit(route('admin.rip-temas.edit', [$ripTema->id])) !!}
                                    {!! cui_btn_delete(route('admin.rip-temas.destroy', [$ripTema->id]), "Anda yakin akan menghapus data Tema ini?") !!}
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
@can('rip_tema_manage')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.rip-temas.massDestroy') }}",
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
  $('.datatable-RipTema:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
