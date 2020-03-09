@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Reviewer Penelitian' => route('admin.penelitian-reviewers.index'),
        'Index' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('penelitian_reviewer_manage')
        {!! cui_toolbar_btn(route('admin.penelitian-reviewers.create'), 'icon-plus', trans('global.add').' '.trans('cruds.penelitianReviewer.title_singular') ) !!}
    @endcan
@stop
@section('content')
<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('cruds.penelitianReviewer.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-PenelitianReviewer" style="width: 100%">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.penelitianReviewer.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.penelitianReviewer.fields.tahapan_review') }}
                        </th>
                        <th>
                            {{ trans('cruds.penelitianReviewer.fields.reviewer') }}
                        </th>
                        <th>
                            {{ trans('cruds.penelitianReviewer.fields.penelitian') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penelitianReviewers as $key => $penelitianReviewer)
                        <tr data-entry-id="{{ $penelitianReviewer->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $penelitianReviewer->id ?? '' }}
                            </td>
                            <td>
                                {{ $penelitianReviewer->tahapan_review->nama ?? '' }}
                            </td>
                            <td>
                                {{ $penelitianReviewer->reviewer->status ?? '' }}
                            </td>
                            <td>
                                {{ $penelitianReviewer->penelitian->judul ?? '' }}
                            </td>
                            <td>
                                @can('penelitian_reviewer_view')
                                    {!! cui_btn_view(route('admin.penelitian-reviewers.show', [$penelitianReviewer->id])) !!}
                                @endcan

                                @can('penelitian_reviewer_manage')
                                    {!! cui_btn_edit(route('admin.penelitian-reviewers.edit', [$penelitianReviewer->id])) !!}
                                    {!! cui_btn_delete(route('admin.penelitian-reviewers.destroy', [$penelitianReviewer->id]), "Anda yakin akan menghapus data Reviewer Penelitian ini?") !!}
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
@can('penelitian_reviewer_manage')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.penelitian-reviewers.massDestroy') }}",
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
  $('.datatable-PenelitianReviewer:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
