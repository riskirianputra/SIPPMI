@can('penelitian_reviewer_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.penelitian-reviewers.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.penelitianReviewer.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.penelitianReviewer.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-PenelitianReviewer">
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
                                @can('penelitian_reviewer_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.penelitian-reviewers.show', $penelitianReviewer->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('penelitian_reviewer_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.penelitian-reviewers.edit', $penelitianReviewer->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('penelitian_reviewer_delete')
                                    <form action="{{ route('admin.penelitian-reviewers.destroy', $penelitianReviewer->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('penelitian_reviewer_delete')
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