@extends('layouts.admin')

@section('breadcrumb')
    {!! cui()->breadcrumb([
        'Home' => url('home'),
        'Kode Rumpun Ilmu' => route('admin.kode-rumpuns.index'),
        'Tambah' => '#'
    ]) !!}
@endsection

@section('toolbar')
    @can('kode_rumpun_view')
        {!! cui()->toolbar_btn(route('admin.kode-rumpuns.index'), 'icon-list', 'List Rumpun Ilmu') !!}
    @endcan
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-8">

            {{ html()->form('POST', route('admin.kode-rumpuns.store'))->class('form')->open() }}

                <div class="card">
                    <div class="card-header">
                        <strong>Tambah Data Kode Rumpun Ilmu</strong>
                    </div>

                    <div class="card-body">
                        @include('admin.kodeRumpuns._form')
                    </div>

                    <div class="card-footer">
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </div>

                </div>

            {{ html()->form()->close() }}
        </div>
    </div>

@endsection
