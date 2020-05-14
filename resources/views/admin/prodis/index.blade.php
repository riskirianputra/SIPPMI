@extends('layouts.admin')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Program Studi' => route('admin.prodis.index'),
        'Index' => '#'
    ]) !!}
@endsection

@section('toolbar')
    @can('prodi_manage')
        {!! cui_toolbar_btn(route('admin.prodis.create'), 'cil-plus', 'Tambah Program Studi') !!}
    @endcan
@endsection

@section('content')
<div class="card">
    <div class="card-header font-weight-bold">
        <i class="cil-list"></i> {{ trans('global.list') }} {{ trans('cruds.prodi.title_singular') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-outline table-striped table-hover datatable datatable-Prodi" style="width: 100%">
                <thead>
                    <tr class="thead-light">
                        <th class="text-center">
                            {{ trans('cruds.prodi.fields.nama') }}
                        </th>
                        <th class="text-center">
                            {{ trans('cruds.prodi.fields.fakultas') }}
                        </th>
                        <th class="text-center">
                            {{ trans('cruds.fakultum.fields.singkatan') }}
                        </th>
                        <th class="text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prodis as $key => $prodi)
                        <tr data-entry-id="{{ $prodi->id }}">
                            <td>
                                {{ $prodi->nama ?? '' }}
                            </td>
                            <td>
                                {{ $prodi->fakultas->nama ?? '' }}
                            </td>
                            <td>
                                {{ $prodi->fakultas->singkatan ?? '' }}
                            </td>
                            <td class="text-center">
                                @can('prodi_view')
                                    {!! cui()->btn_view(route('admin.prodis.show', $prodi->id)) !!}
                                @endcan

                                @can('prodi_manage')
                                    {!! cui()->btn_edit(route('admin.prodis.edit', $prodi->id)) !!}
                                    {!! cui()->btn_delete(route('admin.prodis.destroy', $prodi->id), "Anda yakin akan menghapus data Program Studi ini?") !!}
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
@can('prodi_manage')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.prodis.massDestroy') }}",
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
