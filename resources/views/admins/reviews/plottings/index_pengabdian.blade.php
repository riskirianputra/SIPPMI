@extends('layouts.admin')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Plotting Reviewer' => route('admin.plotting-reviewers.index'),
        'Index' => '#'
    ]) !!}
@endsection

@section('toolbar')
    {!! cui_toolbar_btn(route('admin.plotting-reviewers.rekapitulasi'), 'cil-spreadsheet', 'Rekapitulasi') !!}
@endsection

@section('content')
    <div class="col">
        <div class="row">
            <div class="col-sm-12">

                <<div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary" data-toggle="collapse" href="#collapse-filter" role="button" aria-expanded="false" aria-controls="collapse-filter">
                            Filter
                        </a>
                        <div class="collapse" id="collapse-filter">
                            @include('admins.reviews.plottings.filter')
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header font-weight-bold">
                        <h4>{{ optional($skema)->nama }} </h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered table-striped table-hover datatable datatable-Reviewer"
                                   style="width: 100%">
                                <thead>
                                <tr>
                                    <th>
                                        Nama Tahapan
                                    </th>
                                    <th>
                                        Peneliti
                                    </th>
                                    <th>
                                        Judul Penelitian
                                    </th>
                                    @for($i=0;$i<$jumlahReviewerMax;$i++)
                                        <th>
                                            Reviewer {!! $i+1 !!}
                                        </th>
                                    @endfor
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($tahapans as $key => $tahapan)
                                    <tr data-entry-id="{{ $tahapan['id'] }}">
                                        <td>
                                            {!! $tahapan['nama'] !!}
                                        </td>
                                        <td>
                                            {!! $tahapan['peneliti'] !!}
                                        </td>
                                        <td>
                                            {!! $tahapan['judul'] !!}
                                        </td>
                                        @for($i=0;$i<$jumlahReviewerMax;$i++)
                                            @php($plotted = true)
                                            @if($i<$tahapan['jumlah_reviewer'])
                                                @foreach($plottedReviewer as $key => $pr)
                                                    @if($pr->tahapan_review_id == $tahapan['id'] && $pr->usulan_id == $tahapan['pengabdian_id'])
                                                        <td>
                                                            {!! $pr->reviewer->dosen->nama !!}
                                                            <button
                                                                id="delete-{!! $i !!}-{!! $tahapan['id'] !!}-{!! $tahapan['pengabdian_id'] !!}"
                                                                data-delete-id="delete-{!! $i !!}-{!! $tahapan['id'] !!}-{!! $tahapan['pengabdian_id'] !!}"
                                                                data-plot-id="{!! $pr->id !!}"
                                                                class='myDeleteButton btn btn-sm btn-outline-danger'><i
                                                                    class='fa fa-trash'></i></button>
                                                        </td>
                                                        @php($plottedReviewer->forget($key))
                                                        @php($plotted = false)
                                                        @break
                                                    @endif
                                                @endforeach
                                                @if($plotted == true)
                                                    <td>
                                                        <!-- Small modal -->
                                                        <button
                                                            id="create-{!! $i !!}-{!! $tahapan['id'] !!}-{!! $tahapan['pengabdian_id'] !!}"
                                                            type="button" data-nomor-urut="{!! $i !!}"
                                                            data-tahapan-review-id="{!! $tahapan['id'] !!}"
                                                            data-penelitian-id="{!! $tahapan['pengabdian_id'] !!}"
                                                            class="btn btn-sm btn-outline-success myModalButton"
                                                            data-toggle="modal" data-target="#myModal"><i
                                                                class="fa fa-plus"></i></button>
                                                    </td>
                                                @endif

                                            @else
                                                <td>

                                                </td>
                                            @endif
                                        @endfor
                                    </tr>
                                @empty
                                    data tidak ada
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header font-weight-bold">
                    Add Reviewer
                </div>
                <div class="modal-body" id="myModalBody">
                    <input type="hidden" id="nomor-urut" value="">
                    <input id="the_token" type="hidden" value="{!! csrf_token() !!}">
                    <input id="tahapan_review_id" name="tahapan_review_id" type="hidden" value="">
                    <input id="usulan_id" name="usulan_id" type="hidden" value="">
                    {!! Form::label('reviewer_id', 'Reviewer:') !!}
                    {!! Form::select('reviewer_id',[], null, ['id' => 'reviewer_id','class' => 'form-control select2', 'required']) !!}
                    @if ($errors->has('reviewer_id'))
                        <span class="help-block">
            <strong class="text-red">{{ $errors->first('reviewer_id') }}</strong>
        </span>
                    @endif
                </div>
                <div class="modal-footer">
                    <button id="myRequestButton" class="btn btn-danger"> Save</button>
                    <button type="button" id="cancelModalButton" class="btn btn-secondary" data-dismiss="modal">Close
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="text/javascript">
        var forEach = function (collection, callback, scope) {
            if (Object.prototype.toString.call(collection) === '[object Object]') {
                for (var prop in collection) {
                    if (Object.prototype.hasOwnProperty.call(collection, prop)) {
                        callback.call(scope, collection[prop], prop, collection);
                    }
                }
            } else {
                for (var i = 0, len = collection.length; i < len; i++) {
                    callback.call(scope, collection[i], i, collection);
                }
            }
        };
        $(document).ready(function () {
            $("body").on('click', ".myModalButton", function (e) {

                //get data-id attribute
                let tahapanReviewId = $(e.currentTarget).data('tahapan-review-id');
                let penelitianId = $(e.currentTarget).data('penelitian-id');
                let nomorUrut = $(e.currentTarget).data('nomor-urut');

                //populate the data
                $("#tahapan_review_id").val(tahapanReviewId);
                $("#usulan_id").val(penelitianId);
                $("#nomor-urut").val(nomorUrut);
                let url = "plotting-reviewers/reviewer/" + tahapanReviewId + "/" + penelitianId;
                $("#reviewer_id").hide();

                axios.get(url)
                    .then((response) => {
                        $("#reviewer_id").empty();
                        forEach(response.data, function (value, prop, obj) {
                            $("#reviewer_id").append("<option value='" + prop + "' >" + value + "</option>")
                        });
                        $("#reviewer_id").show();
                    })
                    .catch((error) => {
                        console.log(error);
                    });

            });

            $("#myRequestButton").on('click', function () {
                //populate the dsata
                let token = $("#the_token").val();
                // console.log(token.val());
                let tahapanReviewId = $("#tahapan_review_id").val();
                let penelitianId = $("#usulan_id").val();
                let reviewerId = $("#reviewer_id").val();
                let nomorUrut = $("#nomor-urut").val();
                let url = "{!! route('admin.plotting-reviewers.plot') !!}";

                axios.post(url, {
                    tahapan_review_id: tahapanReviewId,
                    usulan_id: penelitianId,
                    reviewer_id: reviewerId
                })
                    .then(function (response) {
                        if (response.data.error) {
                            alert(response.data.error);
                        } else {
                            alert(response.data.dosen.nama + " berhasil ditambahkan sebagai reviewer");
                            let idNya = "create-" + nomorUrut + "-" + tahapanReviewId + "-" + penelitianId;
                            let gantiNya = "delete-" + nomorUrut + "-" + tahapanReviewId + "-" + penelitianId;
                            let parent = $("#" + idNya).parent();
                            parent.prepend(response.data.dosen.nama + " <button id='" + gantiNya + "' data-plot-id='" + response.data.plot_id + "' data-delete-id='" + gantiNya + "'  class='myDeleteButton btn btn-sm btn-outline-danger'><i class='fa fa-trash'></i></button>");
                            $("#" + idNya).remove();
                            $('#cancelModalButton').click();

                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            });

            $("body").on('click', ".myDeleteButton", function (e) {

                let plotId = $(e.currentTarget).data('plot-id');
                let idDelete = $(e.currentTarget).data('delete-id');

                let tahapanReviewId = idDelete.split("-")[2];
                let penelitianId = idDelete.split("-")[3];
                let nomorUrut = idDelete.split("-")[1];
                let url = "plotting-reviewers/" + plotId + "/plot";

                axios.delete(url)
                    .then(function (response) {
                        if (response.data.error) {
                            alert(response.data.error);
                        } else {
                            alert(response.data.success);
                            let idNya = "delete-" + nomorUrut + "-" + tahapanReviewId + "-" + penelitianId;
                            let gantiNya = "create-" + nomorUrut + "-" + tahapanReviewId + "-" + penelitianId;
                            let parent = $("#" + idNya).parent();
                            parent.empty();
                            parent.prepend(" <button id='" + gantiNya + "' data-nomor-urut='" + nomorUrut + "' data-tahapan-review-id='" + tahapanReviewId + "' data-toggle=\"modal\" data-target=\"#myModal\" data-penelitian-id='" + penelitianId + "' class='myModalButton btn btn-sm btn-outline-success'><i class='fa fa-plus'></i></button>");
                            $("#" + idNya).remove();
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            });

            $.extend(true, $.fn.dataTable.defaults, {
                order: [[1, 'desc']],
                pageLength: 100,
            });
            $('.datatable-Reviewer:not(.ajaxTable)').DataTable()
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        });


    </script>
@endsection
