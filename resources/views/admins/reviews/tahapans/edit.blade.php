@extends('layouts.admin')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Tahapan Reviewer' => route('admin.tahapan-reviews.index'),
        'Edit' => '#'
    ]) !!}
@endsection

@section('toolbar')
    @can('tahapan_review_view')
        {!! cui_toolbar_btn(route('admin.tahapan-reviews.index'), 'cil-list', 'List Tahapan Review') !!}
    @endcan
@endsection

@section('content')
    <div class="col">
        <div class="row">
            <div class="col-sm-8">
                <div class="card">

                    {{ html()->modelForm($tahapanReview, 'PUT', route('admin.tahapan-reviews.update', [$tahapanReview->id]))->open() }}

                    <div class="card-header">
                        Edit Tahapan Review
                    </div>

                    <div class="card-body">
                        @include('admins.reviews.tahapans._form')
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit">
                            Simpan
                        </button>
                    </div>

                    {{ html()->closeModelForm() }}
                </div>
            </div>
        </div>
    </div>
@endsection
