@extends('layouts.admin')

@section('breadcrumb')
    {!! cui()->breadcrumb([
        'Home' => url('home'),
        'Kode Rumpun Ilmu' => route('admin.kode-rumpuns.index'),
        'Edit' => '#'
    ]) !!}
@endsection

@section('toolbar')
    @can('kode_rumpun_view')
        {!! cui()->toolbar_btn(route('admin.kode-rumpuns.index'), 'cil-list', 'List Rumpun Ilmu') !!}
    @endcan
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-8">

            {{ html()->modelForm($kodeRumpun, 'PUT', route('admin.kode-rumpuns.update', [$kodeRumpun->id]))->class('form')->open() }}

            <div class="card">

                <div class="card-header">
                    <strong><i class="cil-pencil"></i> Edit Data Kode Rumpun Ilmu</strong>
                </div>

                <div class="card-body">
                    @include('admins.referensis.kode_rumpuns._form')
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


@endsection
