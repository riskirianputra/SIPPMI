@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Tahapan' => route('admin.rip-tahapans.index'),
        'Edit' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('rip_tahapan_view')
        {!! cui_toolbar_btn(route('admin.rip-tahapans.index'), 'icon-list', trans('global.list').' '.trans('cruds.ripTahapan.title_singular') ) !!}
    @endcan
@stop
@section('content')
<div class="col">
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    {{ trans('global.edit') }} {{ trans('cruds.ripTahapan.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("admin.rip-tahapans.update", [$ripTahapan->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="sub_topik_id">{{ trans('cruds.ripTahapan.fields.sub_topik') }}</label>
                            <select class="form-control select2 {{ $errors->has('sub_topik') ? 'is-invalid' : '' }}" name="sub_topik_id" id="sub_topik_id">
                                @foreach($sub_topiks as $id => $sub_topik)
                                    <option value="{{ $id }}" {{ ($ripTahapan->sub_topik ? $ripTahapan->sub_topik->id : old('sub_topik_id')) == $id ? 'selected' : '' }}>{{ $sub_topik }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('sub_topik_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sub_topik_id') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ripTahapan.fields.sub_topik_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="tahun">{{ trans('cruds.ripTahapan.fields.tahun') }}</label>
                            <input class="form-control {{ $errors->has('tahun') ? 'is-invalid' : '' }}" type="number" name="tahun" id="tahun" value="{{ old('tahun', $ripTahapan->tahun) }}" step="1">
                            @if($errors->has('tahun'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tahun') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ripTahapan.fields.tahun_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="bahasan">{{ trans('cruds.ripTahapan.fields.bahasan') }}</label>
                            <textarea class="form-control ckeditor {{ $errors->has('bahasan') ? 'is-invalid' : '' }}" name="bahasan" id="bahasan">{!! old('bahasan', $ripTahapan->bahasan) !!}</textarea>
                            @if($errors->has('bahasan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bahasan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ripTahapan.fields.bahasan_helper') }}</span>
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
