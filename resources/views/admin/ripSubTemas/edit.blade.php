@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Sub Tema' => route('admin.rip-sub-temas.index'),
        'Edit' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('rip_sub_tema_view')
        {!! cui_toolbar_btn(route('admin.rip-sub-temas.index'), 'icon-list', trans('global.list').' '.trans('cruds.ripSubTema.title_singular') ) !!}
    @endcan
@stop
@section('content')
<div class="col">
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    {{ trans('global.edit') }} {{ trans('cruds.ripSubTema.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("admin.rip-sub-temas.update", [$ripSubTema->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="tema_id">{{ trans('cruds.ripSubTema.fields.tema') }}</label>
                            <select class="form-control select2 {{ $errors->has('tema') ? 'is-invalid' : '' }}" name="tema_id" id="tema_id">
                                @foreach($temas as $id => $tema)
                                    <option value="{{ $id }}" {{ ($ripSubTema->tema ? $ripSubTema->tema->id : old('tema_id')) == $id ? 'selected' : '' }}>{{ $tema }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('tema_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tema_id') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ripSubTema.fields.tema_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="nama">{{ trans('cruds.ripSubTema.fields.nama') }}</label>
                            <input class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" type="text" name="nama" id="nama" value="{{ old('nama', $ripSubTema->nama) }}">
                            @if($errors->has('nama'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nama') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ripSubTema.fields.nama_helper') }}</span>
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
