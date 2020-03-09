@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('user.home'),
        'Fokus' => route('prn-fokus.index'),
        'Create' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('prn_fokus_view')
        {!! cui_toolbar_btn(route('prn-fokus.index'), 'icon-list', 'List Fokus' ) !!}
    @endcan
@stop
@section('content')
<div class="col">
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Create Fokus
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("prn-fokus.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="required" for="nama">Nama</label>
                            <input class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" type="text" name="nama" id="nama" value="{{ old('nama', '') }}" required>
                            @if($errors->has('nama'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nama') }}
                                </div>
                            @endif
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
