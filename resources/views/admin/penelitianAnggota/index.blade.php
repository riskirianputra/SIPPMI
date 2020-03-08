@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Anggota Penelitian' => route('admin.penelitian-anggota.index'),
        'Index' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('penelitian_anggotum_manage')
        {!! cui_toolbar_btn(route('admin.penelitian-anggota.create'), 'icon-plus', trans('global.add').' '.trans('cruds.penelitianAnggotum.title_singular') ) !!}
    @endcan
@stop
@section('content')
<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('cruds.penelitianAnggotum.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-PenelitianAnggotum">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.penelitianAnggotum.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.penelitianAnggotum.fields.dosen') }}
                        </th>
                        <th>
                            {{ trans('cruds.dosen.fields.nip') }}
                        </th>
                        <th>
                            {{ trans('cruds.penelitianAnggotum.fields.penelitian') }}
                        </th>
                        <th>
                            {{ trans('cruds.penelitianAnggotum.fields.jabatan') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penelitianAnggota as $key => $penelitianAnggotum)
                        <tr data-entry-id="{{ $penelitianAnggotum->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $penelitianAnggotum->id ?? '' }}
                            </td>
                            <td>
                                {{ $penelitianAnggotum->dosen->nama ?? '' }}
                            </td>
                            <td>
                                {{ $penelitianAnggotum->dosen->nip ?? '' }}
                            </td>
                            <td>
                                {{ $penelitianAnggotum->penelitian->judul ?? '' }}
                            </td>
                            <td>
                                {{ App\PenelitianAnggotum::JABATAN_SELECT[$penelitianAnggotum->jabatan] ?? '' }}
                            </td>
                            <td>
                                @can('penelitian_anggotum_view')
                                    {!! cui_btn_view(route('admin.penelitian-anggota.show', [$penelitianAnggotum->id])) !!}
                                @endcan

                                @can('penelitian_anggotum_manage')
                                    {!! cui_btn_edit(route('admin.penelitian-anggota.edit', [$penelitianAnggotum->id])) !!}
                                    {!! cui_btn_delete(route('admin.penelitian-anggota.destroy', [$penelitianAnggotum->id]), "Anda yakin akan menghapus data Anggota Penelitian ini?") !!}
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
@can('penelitian_anggotum_manage')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.penelitian-anggota.massDestroy') }}",
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
  $('.datatable-PenelitianAnggotum:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
