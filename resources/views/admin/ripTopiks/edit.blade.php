@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Topik' => route('admin.rip-topiks.index'),
        'Edit' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('rip_topik_view')
        {!! cui_toolbar_btn(route('admin.prodis.index'), 'icon-list', trans('global.list').' '.trans('cruds.ripTopik.title_singular') ) !!}
    @endcan
@stop
@section('content')
<div class="col">
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    {{ trans('global.edit') }} {{ trans('cruds.ripTopik.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("admin.rip-topiks.update", [$ripTopik->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="subtema_id">{{ trans('cruds.ripTopik.fields.subtema') }}</label>
                            <select class="form-control select2 {{ $errors->has('subtema') ? 'is-invalid' : '' }}" name="subtema_id" id="subtema_id">
                                @foreach($subtemas as $id => $subtema)
                                    <option value="{{ $id }}" {{ ($ripTopik->subtema ? $ripTopik->subtema->id : old('subtema_id')) == $id ? 'selected' : '' }}>{{ $subtema }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('subtema_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('subtema_id') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ripTopik.fields.subtema_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="nama">{{ trans('cruds.ripTopik.fields.nama') }}</label>
                            <input class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" type="text" name="nama" id="nama" value="{{ old('nama', $ripTopik->nama) }}">
                            @if($errors->has('nama'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nama') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ripTopik.fields.nama_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="luaran">{{ trans('cruds.ripTopik.fields.luaran') }}</label>
                            <textarea class="form-control ckeditor {{ $errors->has('luaran') ? 'is-invalid' : '' }}" name="luaran" id="luaran">{!! old('luaran', $ripTopik->luaran) !!}</textarea>
                            @if($errors->has('luaran'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('luaran') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ripTopik.fields.luaran_helper') }}</span>
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
