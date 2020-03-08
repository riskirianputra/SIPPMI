@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Reviewer' => route('admin.reviewers.index'),
        'Index' => '#'
    ]) !!}
@stop
@section('content')
<div class="col">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header font-weight-bold">
                    {!! trans('global.add').' '.trans('cruds.reviewer.title_singular') !!}
                </div>
                <div class="card-body">
                    @include('admin.reviewers.create')
                </div>
            </div>
            <div class="card">
                <div class="card-header font-weight-bold">
                    {{ trans('cruds.reviewer.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Reviewer">
                            <thead>
                            <tr>
                                <th>
                                    {{ trans('cruds.dosen.fields.nama') }}
                                </th>
                                <th>
                                    {{ trans('cruds.dosen.fields.nidn') }}
                                </th>
                                <th>
                                    {{ trans('cruds.reviewer.fields.status') }}
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reviewers as $key => $reviewer)
                                <tr data-entry-id="{{ $reviewer->id }}">
                                    <td>
                                        {!! $reviewer->dosen->nama !!}
                                    </td>
                                    <td>
                                        {!! $reviewer->dosen->nidn !!}
                                    </td>
                                    <td>
                                        @can('reviewer_manage')
                                            @if($reviewer->status == 1)
                                                {!! cui_btn_deactive($reviewer, route('admin.reviewers.update',[$reviewer->id]), 'deactive') !!}
                                            @elseif($reviewer->status == 2)
                                                {!! cui_btn_active($reviewer, route('admin.reviewers.update',[$reviewer->id]), 'active') !!}
                                            @endif
                                        @endcan
                                    </td>
                                    <td>
                                        @can('reviewer_manage')
                                            {!! cui_btn_delete(route('admin.reviewers.destroy', [$reviewer->id]), "Anda yakin akan menghapus data Reviewer ini?") !!}
                                        @endcan
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection
