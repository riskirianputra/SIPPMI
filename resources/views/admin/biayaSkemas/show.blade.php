@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.show') }} {{ trans('cruds.biayaSkema.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.biaya-skemas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.biayaSkema.fields.biaya') }}
                        </th>
                        <td>
                            {{ $biayaSkema->biaya->nama ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.biayaSkema.fields.persen_max') }}
                        </th>
                        <td>
                            {{ $biayaSkema->persen_max }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.biayaSkema.fields.persen_min') }}
                        </th>
                        <td>
                            {{ $biayaSkema->persen_min }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.biaya-skemas.index') }}">
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
            <a class="nav-link" href="#biaya_skema_penelitian_biayas" role="tab" data-toggle="tab">
                {{ trans('cruds.penelitianBiaya.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#biaya_skema_pengabdian_biayas" role="tab" data-toggle="tab">
                {{ trans('cruds.pengabdianBiaya.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="biaya_skema_penelitian_biayas">
            @includeIf('admin.biayaSkemas.relationships.biayaSkemaPenelitianBiayas', ['penelitianBiayas' => $biayaSkema->biayaSkemaPenelitianBiayas])
        </div>
        <div class="tab-pane" role="tabpanel" id="biaya_skema_pengabdian_biayas">
            @includeIf('admin.biayaSkemas.relationships.biayaSkemaPengabdianBiayas', ['pengabdianBiayas' => $biayaSkema->biayaSkemaPengabdianBiayas])
        </div>
    </div>
</div>

@endsection
