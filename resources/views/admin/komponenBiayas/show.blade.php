@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.show') }} {{ trans('cruds.komponenBiaya.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.komponen-biayas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.komponenBiaya.fields.nama') }}
                        </th>
                        <td>
                            {{ $komponenBiaya->nama }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.komponenBiaya.fields.keterangan') }}
                        </th>
                        <td>
                            {{ $komponenBiaya->keterangan }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.komponen-biayas.index') }}">
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
            <a class="nav-link" href="#biaya_biaya_skemas" role="tab" data-toggle="tab">
                {{ trans('cruds.biayaSkema.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="biaya_biaya_skemas">
            @includeIf('admin.komponenBiayas.relationships.biayaBiayaSkemas', ['biayaSkemas' => $komponenBiaya->biayaBiayaSkemas])
        </div>
    </div>
</div>

@endsection
