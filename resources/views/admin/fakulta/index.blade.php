@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Fakultas' => route('admin.fakulta.index'),
        'Index' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('fakultum_manage')
        {!! cui_toolbar_btn(route('admin.fakulta.create'), 'icon-plus', trans('global.add').' '.trans('cruds.fakultum.title_singular') ) !!}
    @endcan
@stop
@section('content')

@can('fakultum_manage')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.fakulta.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.fakultum.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('cruds.fakultum.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Fakultum" style="width: 100%">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.fakultum.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.fakultum.fields.nama') }}
                        </th>
                        <th>
                            {{ trans('cruds.fakultum.fields.singkatan') }}
                        </th>
                        <th>
                            {{ trans('cruds.fakultum.fields.kode') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($fakulta as $key => $fakultum)
                        <tr data-entry-id="{{ $fakultum->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $fakultum->id ?? '' }}
                            </td>
                            <td>
                                {{ $fakultum->nama ?? '' }}
                            </td>
                            <td>
                                {{ $fakultum->singkatan ?? '' }}
                            </td>
                            <td>
                                {{ $fakultum->kode ?? '' }}
                            </td>
                            <td>

                                @can('fakultum_manage')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.fakulta.edit', $fakultum->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('fakultum_manage')
                                    <form action="{{ route('admin.fakulta.destroy', $fakultum->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
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
@can('fakultum_manage')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.fakulta.massDestroy') }}",
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
  $('.datatable-Fakultum:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
