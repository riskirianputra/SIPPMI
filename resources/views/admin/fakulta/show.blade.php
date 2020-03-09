@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.show') }} {{ trans('cruds.fakultum.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fakulta.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.fakultum.fields.id') }}
                        </th>
                        <td>
                            {{ $fakultum->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fakultum.fields.nama') }}
                        </th>
                        <td>
                            {{ $fakultum->nama }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fakultum.fields.singkatan') }}
                        </th>
                        <td>
                            {{ $fakultum->singkatan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fakultum.fields.kode') }}
                        </th>
                        <td>
                            {{ $fakultum->kode }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fakulta.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#fakultas_prodis" role="tab" data-toggle="tab">
                {{ trans('cruds.prodi.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="fakultas_prodis">
            @includeIf('admin.fakulta.relationships.fakultasProdis', ['prodis' => $fakultum->fakultasProdis])
        </div>
    </div>
</div>

@endsection
