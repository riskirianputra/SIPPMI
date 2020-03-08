@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Sub Topik' => route('admin.rip-sub-topiks.index'),
        'Edit' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('rip_sub_topik_view')
        {!! cui_toolbar_btn(route('admin.rip-sub-topiks.index'), 'icon-list', trans('global.list').' '.trans('cruds.ripSubTopik.title_singular') ) !!}
    @endcan
@stop
@section('content')
<div class="col">
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    {{ trans('global.edit') }} {{ trans('cruds.ripSubTopik.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("admin.rip-sub-topiks.update", [$ripSubTopik->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="topik_id">{{ trans('cruds.ripSubTopik.fields.topik') }}</label>
                            <select class="form-control select2 {{ $errors->has('topik') ? 'is-invalid' : '' }}" name="topik_id" id="topik_id">
                                @foreach($topiks as $id => $topik)
                                    <option value="{{ $id }}" {{ ($ripSubTopik->topik ? $ripSubTopik->topik->id : old('topik_id')) == $id ? 'selected' : '' }}>{{ $topik }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('topik_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('topik_id') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ripSubTopik.fields.topik_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="nama">{{ trans('cruds.ripSubTopik.fields.nama') }}</label>
                            <input class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" type="text" name="nama" id="nama" value="{{ old('nama', $ripSubTopik->nama) }}">
                            @if($errors->has('nama'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nama') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ripSubTopik.fields.nama_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="luaran">{{ trans('cruds.ripSubTopik.fields.luaran') }}</label>
                            <input class="form-control {{ $errors->has('luaran') ? 'is-invalid' : '' }}" type="text" name="luaran" id="luaran" value="{{ old('luaran', $ripSubTopik->luaran) }}">
                            @if($errors->has('luaran'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('luaran') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ripSubTopik.fields.luaran_helper') }}</span>
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
