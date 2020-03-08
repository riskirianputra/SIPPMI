@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.show') }} {{ trans('cruds.jenisUsulan.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.jenis-usulans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.jenisUsulan.fields.id') }}
                        </th>
                        <td>
                            {{ $jenisUsulan->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jenisUsulan.fields.kode') }}
                        </th>
                        <td>
                            {{ $jenisUsulan->kode }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jenisUsulan.fields.nama') }}
                        </th>
                        <td>
                            {{ $jenisUsulan->nama }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.jenis-usulans.index') }}">
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
            <a class="nav-link" href="#jenis_usulan_ref_skemas" role="tab" data-toggle="tab">
                {{ trans('cruds.refSkema.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#jenis_usulan_outputs" role="tab" data-toggle="tab">
                {{ trans('cruds.output.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="jenis_usulan_ref_skemas">
            @includeIf('admin.jenisUsulans.relationships.jenisUsulanRefSkemas', ['refSkemas' => $jenisUsulan->jenisUsulanRefSkemas])
        </div>
        <div class="tab-pane" role="tabpanel" id="jenis_usulan_outputs">
            @includeIf('admin.jenisUsulans.relationships.jenisUsulanOutputs', ['outputs' => $jenisUsulan->jenisUsulanOutputs])
        </div>
    </div>
</div>

@endsection
