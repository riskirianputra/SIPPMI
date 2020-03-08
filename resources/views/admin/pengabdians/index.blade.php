@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Pengabdian' => route('admin.pengabdians.index'),
        'Index' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('pengabdian_manage')
        {!! cui_toolbar_btn(route('admin.pengabdians.create'), 'icon-plus', trans('global.add').' '.trans('cruds.pengabdian.title_singular') ) !!}
    @endcan
@stop
@section('content')
<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('cruds.pengabdian.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Pengabdian">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.pengabdian.fields.judul') }}
                        </th>
                        <th>
                            {{ trans('cruds.pengabdian.fields.mitra_pengabdian') }}
                        </th>
                        <th>
                            {{ trans('cruds.pengabdian.fields.skema') }}
                        </th>
                        <th>
                            {{ trans('cruds.pengabdian.fields.prodi') }}
                        </th>
                        <th>
                            {{ trans('cruds.pengabdian.fields.status_pengabdian') }}
                        </th>
                        <th>
                            {{ trans('cruds.pengabdian.fields.biaya') }}
                        </th>
                        <th>
                            {{ trans('cruds.pengabdian.fields.file_proposal') }}
                        </th>
                        <th>
                            {{ trans('cruds.pengabdian.fields.file_profile_pengabdian') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengabdians as $key => $pengabdian)
                        <tr data-entry-id="{{ $pengabdian->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $pengabdian->judul ?? '' }}
                            </td>
                            <td>
                                {{ $pengabdian->mitra_pengabdian ?? '' }}
                            </td>
                            <td>
                                {{ $pengabdian->skema->nama ?? '' }}
                            </td>
                            <td>
                                {{ $pengabdian->prodi->nama ?? '' }}
                            </td>
                            <td>
                                {{ $pengabdian->status_pengabdian ?? '' }}
                            </td>
                            <td>
                                {{ $pengabdian->biaya ?? '' }}
                            </td>
                            <td>
                                @if($pengabdian->file_proposal)
                                    <a href="{{ $pengabdian->file_proposal->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                            <td>
                                @if($pengabdian->file_profile_pengabdian)
                                    <a href="{{ $pengabdian->file_profile_pengabdian->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                            <td>
                                @can('pengabdian_view')
                                    {!! cui_btn_view(route('admin.pengabdians.show', [$pengabdian->id])) !!}
                                @endcan

                                @can('pengabdian_manage')
                                    {!! cui_btn_edit(route('admin.pengabdians.edit', [$pengabdian->id])) !!}
                                    {!! cui_btn_delete(route('admin.pengabdians.destroy', [$pengabdian->id]), "Anda yakin akan menghapus data Pengabdian ini?") !!}
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
@can('pengabdian_manage')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.pengabdians.massDestroy') }}",
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
  $('.datatable-Pengabdian:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
