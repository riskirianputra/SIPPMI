@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Reviewer Penelitian' => route('admin.penelitian-reviewers.index'),
        'Detail' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('penelitian_reviewer_manage')
        {!! cui_toolbar_btn(route('admin.penelitian-reviewers.index'), 'icon-list', trans('global.list').' '.trans('cruds.penelitianReviewer.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.penelitian-reviewers.edit',[$penelitianReviewer->id]), 'icon-pencil', trans('global.edit').' '.trans('cruds.penelitianReviewer.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.penelitian-reviewers.destroy',[$penelitianReviewer->id]), 'icon-trash', trans('global.delete').' '.trans('cruds.penelitianReviewer.title_singular') ) !!}
    @endcan
@stop
@section('content')

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.show') }} {{ trans('cruds.penelitianReviewer.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.penelitianReviewer.fields.id') }}
                        </th>
                        <td>
                            {{ $penelitianReviewer->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.penelitianReviewer.fields.tahapan_review') }}
                        </th>
                        <td>
                            {{ $penelitianReviewer->tahapan_review->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.penelitianReviewer.fields.reviewer') }}
                        </th>
                        <td>
                            {{ $penelitianReviewer->reviewer->status ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.penelitianReviewer.fields.penelitian') }}
                        </th>
                        <td>
                            {{ $penelitianReviewer->penelitian->judul ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
