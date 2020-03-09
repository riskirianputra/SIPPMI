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
            <table class="table table-striped table-hover datatable datatable-Pengabdian" style="width: 100%">
                <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        Peneliti
                    </th>
                    <th class="text-center">
                        {{ trans('cruds.pengabdian.fields.judul') }}
                        ( {{ trans('cruds.pengabdian.fields.skema') }} )
                    </th>
                    <th class="text-center">
                        {{ trans('cruds.pengabdian.fields.biaya') }}
                    </th>
                    <th class="text-center">
                        Proposal
                    </th>
                    <th class="text-center">
                        CV
                    </th>
                    <th class="text-center">
                        Lembaran<br>Pengesahan
                    </th>
                    <th class="text-center">
                        Status<br>Pengabdian
                    </th>
                    <th class="text-center">
                        &nbsp;Aksi
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($pengabdians as $key => $pengabdian)
                    <tr data-entry-id="{{ $pengabdian->id }}" @if($pengabdian->hasKomentar())class="bg-warning" @endif>
                        <td>

                        </td>
                        <td>

                            @foreach($pengabdian->anggotas as $anggota)
                                @if($anggota->jabatan == 1)
                                    <strong>{{ $anggota->nama }} <small>({{ $anggota->nidn }})</small></strong> <br>
                                    <br>
                                @else
                                    {{ $anggota->nama }} <small>({{ $anggota->nidn }})</small><br>
                                @endif
                            @endforeach

                        </td>
                        <td>
                            {!! $pengabdian->judulSimple ?? '' !!}
                            <br>
                            <span class="text-info">
                                    <small><em>{{ $pengabdian->skema->nama ?? '' }}</em></small>
                                </span>
                            <br>
                            @if($pengabdian->hasKomentar())
                                <i class="cil-warning text-warning"></i>
                            @endif
                        </td>
                        <td class="text-right">
                            {{ number_format($pengabdian->biaya,0, ',', '.').',-' ?? '' }}
                        </td>
                        <td class="text-center">
                            @if(!empty($pengabdian->file_proposal))
                                <a href="{{ $pengabdian->getFileProposalPath() }}" target="_blank">
                                    <i class="fa fa-file-pdf-o text-danger"></i>
                                </a>
                            @endif
                        </td>
                        <td class="text-center">
                            @if(!empty($pengabdian->file_cv))
                                <a href="{{ $pengabdian->getFileCvPath() }}" target="_blank">
                                    <i class="fa fa-file-pdf-o text-danger"></i>
                                </a>
                            @endif

                        </td>
                        <td class="text-center">
                            @if(!empty($pengabdian->file_pengesahan))
                                <a href="{{ $pengabdian->getFilePengesahanPath() }}" target="_blank">
                                    <i class="fa fa-file-pdf-o text-danger"></i>
                                </a>
                            @endif

                        </td>
                        <td class="text-center">
                            <h5>
                                    <span class="badge badge-{!! $pengabdian->statusTextColor !!}">
                                       {{ $pengabdian->statusText }}
                                    </span>
                            </h5>

                        </td>
                        <td class="text-center">
                            {!! cui()->btn_view(route('admin.pengabdians.show', $pengabdian->id)) !!}
                            @if($pengabdian->owner == auth()->user()->id)
                                {!! cui()->btn_edit(route('admin.pengabdians.edit', $pengabdian->id)) !!}
                                {!! cui()->btn_delete(route('admin.pengabdians.destroy', $pengabdian->id), trans('global.areYouSure')) !!}
                            @endif
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
