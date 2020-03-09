@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Reviewer Penelitian' => route('admin.penelitian-reviewers.index'),
        'Edit' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('penelitian_reviewer_view')
        {!! cui_toolbar_btn(route('admin.penelitian-reviewers.index'), 'icon-list', trans('global.list').' '.trans('cruds.penelitianReviewer.title_singular') ) !!}
    @endcan
@stop
@section('content')
<div class="col">
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    {{ trans('global.edit') }} {{ trans('cruds.penelitianReviewer.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("admin.penelitian-reviewers.update", [$penelitianReviewer->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="tahapan_review_id">{{ trans('cruds.penelitianReviewer.fields.tahapan_review') }}</label>
                            <select class="form-control select2 {{ $errors->has('tahapan_review') ? 'is-invalid' : '' }}" name="tahapan_review_id" id="tahapan_review_id" required>
                                @foreach($tahapan_reviews as $id => $tahapan_review)
                                    <option value="{{ $id }}" {{ ($penelitianReviewer->tahapan_review ? $penelitianReviewer->tahapan_review->id : old('tahapan_review_id')) == $id ? 'selected' : '' }}>{{ $tahapan_review }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('tahapan_review_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tahapan_review_id') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.penelitianReviewer.fields.tahapan_review_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="reviewer_id">{{ trans('cruds.penelitianReviewer.fields.reviewer') }}</label>
                            <select class="form-control select2 {{ $errors->has('reviewer') ? 'is-invalid' : '' }}" name="reviewer_id" id="reviewer_id" required>
                                @foreach($reviewers as $id => $reviewer)
                                    <option value="{{ $id }}" {{ ($penelitianReviewer->reviewer ? $penelitianReviewer->reviewer->id : old('reviewer_id')) == $id ? 'selected' : '' }}>{{ $reviewer }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('reviewer_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('reviewer_id') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.penelitianReviewer.fields.reviewer_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="penelitian_id">{{ trans('cruds.penelitianReviewer.fields.penelitian') }}</label>
                            <select class="form-control select2 {{ $errors->has('penelitian') ? 'is-invalid' : '' }}" name="penelitian_id" id="penelitian_id">
                                @foreach($penelitians as $id => $penelitian)
                                    <option value="{{ $id }}" {{ ($penelitianReviewer->penelitian ? $penelitianReviewer->penelitian->id : old('penelitian_id')) == $id ? 'selected' : '' }}>{{ $penelitian }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('penelitian_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('penelitian_id') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.penelitianReviewer.fields.penelitian_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
