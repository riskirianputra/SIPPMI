@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Anggota Pengabdian' => route('admin.pengabdian-anggota.index'),
        'Index' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('pengabdian_anggotum_manage')
        {!! cui_toolbar_btn(route('admin.pengabdian-anggota.create'), 'icon-plus', trans('global.add').' '.trans('cruds.pengabdianAnggotum.title_singular') ) !!}
    @endcan
@stop
@section('content')
<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('cruds.pengabdianAnggotum.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-PengabdianAnggotum">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.pengabdianAnggotum.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.pengabdianAnggotum.fields.pengabdian') }}
                        </th>
                        <th>
                            {{ trans('cruds.pengabdianAnggotum.fields.dosen') }}
                        </th>
                        <th>
                            {{ trans('cruds.dosen.fields.nip') }}
                        </th>
                        <th>
                            {{ trans('cruds.pengabdianAnggotum.fields.jabatan') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengabdianAnggota as $key => $pengabdianAnggotum)
                        <tr data-entry-id="{{ $pengabdianAnggotum->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $pengabdianAnggotum->id ?? '' }}
                            </td>
                            <td>
                                {{ $pengabdianAnggotum->pengabdian->judul ?? '' }}
                            </td>
                            <td>
                                {{ $pengabdianAnggotum->dosen->nama ?? '' }}
                            </td>
                            <td>
                                {{ $pengabdianAnggotum->dosen->nip ?? '' }}
                            </td>
                            <td>
                                {{ App\PengabdianAnggotum::JABATAN_SELECT[$pengabdianAnggotum->jabatan] ?? '' }}
                            </td>
                            <td>
                                @can('pengabdian_anggotum_view')
                                    {!! cui_btn_view(route('admin.pengabdian-anggota.show', [$pengabdianAnggotum->id])) !!}
                                @endcan

                                @can('pengabdian_anggotum_manage')
                                    {!! cui_btn_edit(route('admin.pengabdian-anggota.edit', [$pengabdianAnggotum->id])) !!}
                                    {!! cui_btn_delete(route('admin.pengabdian-anggota.destroy', [$pengabdianAnggotum->id]), "Anda yakin akan menghapus data Anggota Pengabidan ini?") !!}
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
@can('pengabdian_anggotum_manage')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.pengabdian-anggota.massDestroy') }}",
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
  $('.datatable-PengabdianAnggotum:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
