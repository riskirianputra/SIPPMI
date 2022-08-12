@extends('layouts.admin')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Tahapan Reviewer' => route('admin.tahapan-reviews.index'),
        'Index' => '#'
    ]) !!}
@stop

@section('toolbar')
    @can('tahapan_review_manage')
        {!! cui_toolbar_btn(route('admin.tahapan-reviews.create'), 'cil-plus', 'Tambah Tahapan Review' ) !!}
    @endcan
@stop

@section('content')
<div class="card">
    <div class="card-header font-weight-bold">
        List Tahapan Review
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover" style="width: 100%">
                <thead>
                    <tr>
                        <th>
                            Nama Tahapan
                        </th>
                        <th class="text-center">
                            Jumlah Reviewer
                        </th>
                        <th class="text-center">
                            Tahun
                        </th>
                        <th class="text-center">
                            Periode Review
                        </th>
                        <th class="text-center">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tahapanReviews as $key => $tahapanReview)
                        <tr data-entry-id="{{ $tahapanReview->id }}">
                            <td>
                                {{ $tahapanReview->nama ?? '' }}
                            </td>
                            <td class="text-center">
                                {{ $tahapanReview->jumlah_reviewer ?? '' }}
                            </td>
                            <td class="text-center">
                                {{ $tahapanReview->tahun ?? '' }}
                            </td>
                            <td class="text-center">
                                {{ $tahapanReview->mulai ?? '' }} <strong>s/d</strong> {{ $tahapanReview->selesai ?? '' }}
                            </td>
                            <td class="text-center">
                                @can('tahapan_review_manage')
                                    {!! cui_btn_edit(route('admin.tahapan-reviews.edit', [$tahapanReview->id])) !!}
                                    {!! cui_btn_delete(route('admin.tahapan-reviews.destroy', [$tahapanReview->id]), "Anda yakin akan menghapus data Tahapan Reviewer ini?") !!}
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
@can('tahapan_review_manage')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.tahapan-reviews.massDestroy') }}",
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
  $('.datatable-TahapanReview:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
