@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Dosen' => route('admin.dosens.index'),
        'Index' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('dosen_manage')
        {!! cui_toolbar_btn(route('admin.dosens.create'), 'icon-plus', trans('global.add').' '.trans('cruds.dosen.title_singular') ) !!}
    @endcan
@stop
@section('content')
<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('cruds.dosen.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Dosen" style="width: 100%">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.dosen.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.dosen.fields.nama') }}
                        </th>
                        <th>
                            {{ trans('cruds.dosen.fields.nip') }}
                        </th>
                        <th>
                            {{ trans('cruds.dosen.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.dosen.fields.prodi') }}
                        </th>
                        <th>
                            {{ trans('cruds.prodi.fields.kode_dikti') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dosens as $key => $dosen)
                        <tr data-entry-id="{{ $dosen->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $dosen->id ?? '' }}
                            </td>
                            <td>
                                {{ $dosen->nama ?? '' }}
                            </td>
                            <td>
                                {{ $dosen->nip ?? '' }}
                            </td>
                            <td>
                                {{ $dosen->email ?? '' }}
                            </td>
                            <td>
                                {{ $dosen->prodi->nama ?? '' }}
                            </td>
                            <td>
                                {{ $dosen->prodi->kode_dikti ?? '' }}
                            </td>
                            <td>
                                @can('dosen_view')
                                    {!! cui_btn_view(route('admin.dosens.show', [$dosen->id])) !!}
                                @endcan

                                @can('dosen_manage')
                                    {!! cui_btn_edit(route('admin.dosens.edit', [$dosen->id])) !!}
                                    {!! cui_btn_delete(route('admin.dosens.destroy', [$dosen->id]), "Anda yakin akan menghapus data dosen ini?") !!}
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
@can('dosen_manage')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.dosens.massDestroy') }}",
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
    pageLength: 10,
  });
  $('.datatable-Dosen:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
