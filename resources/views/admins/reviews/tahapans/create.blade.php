@extends('layouts.admin')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Tahapan Reviewer' => route('admin.tahapan-reviews.index'),
        'Create' => '#'
    ]) !!}
@endsection

@section('toolbar')
    @can('tahapan_review_view')
        {!! cui_toolbar_btn(route('admin.tahapan-reviews.index'), 'cil-list', 'Daftar Tahapan') !!}
    @endcan
@endsection

@section('content')
    <div class="col">
        <div class="row">
            <div class="col-sm-8">

                {{ html()->form('POST', route('admin.tahapan-reviews.store'))->open() }}

                <div class="card">
                    <div class="card-header font-weight-bold">
                        Tambah Tahapan Review
                    </div>

                    <div class="card-body">
                        @include('admins.reviews.tahapans._form')
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                </div>

                {{ html()->closeModelForm() }}
            </div>
        </div>
    </div>
@endsection
