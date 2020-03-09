@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Output Penelitian' => route('admin.penelitian-outputs.index'),
        'Index' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('penelitian_output_manage')
        {!! cui_toolbar_btn(route('admin.penelitian-outputs.create'), 'icon-plus', trans('global.add').' '.trans('cruds.penelitianOutput.title_singular') ) !!}
    @endcan
@stop
@section('content')
<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('cruds.penelitianOutput.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-PenelitianOutput" style="width: 100%">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.penelitianOutput.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.penelitianOutput.fields.output_skema') }}
                        </th>
                        <th>
                            {{ trans('cruds.penelitianOutput.fields.penelitian') }}
                        </th>
                        <th>
                            {{ trans('cruds.penelitianOutput.fields.filename') }}
                        </th>
                        <th>
                            {{ trans('cruds.penelitianOutput.fields.tanggal_upload') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penelitianOutputs as $key => $penelitianOutput)
                        <tr data-entry-id="{{ $penelitianOutput->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $penelitianOutput->id ?? '' }}
                            </td>
                            <td>
                                {{ $penelitianOutput->output_skema->field ?? '' }}
                            </td>
                            <td>
                                {{ $penelitianOutput->penelitian->judul ?? '' }}
                            </td>
                            <td>
                                {{ $penelitianOutput->filename ?? '' }}
                            </td>
                            <td>
                                {{ $penelitianOutput->tanggal_upload ?? '' }}
                            </td>
                            <td>
                                @can('penelitian_output_view')
                                    {!! cui_btn_view(route('admin.penelitian-outputs.show', [$penelitianOutput->id])) !!}
                                @endcan

                                @can('penelitian_output_manage')
                                    {!! cui_btn_edit(route('admin.penelitian-outputs.edit', [$penelitianOutput->id])) !!}
                                    {!! cui_btn_delete(route('admin.penelitian-outputs.destroy', [$penelitianOutput->id]), "Anda yakin akan menghapus data Output Penelitian ini?") !!}
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
@can('penelitian_output_manage')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.penelitian-outputs.massDestroy') }}",
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
  $('.datatable-PenelitianOutput:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
