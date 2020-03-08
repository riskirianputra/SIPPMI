@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.usulan.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.usulans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.usulan.fields.id') }}
                        </th>
                        <td>
                            {{ $usulan->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.usulan.fields.pengusul') }}
                        </th>
                        <td>
                            {{ $usulan->pengusul->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.usulan.fields.status_usulan') }}
                        </th>
                        <td>
                            {{ App\Usulan::STATUS_USULAN_SELECT[$usulan->status_usulan] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.usulan.fields.jenis_usulan') }}
                        </th>
                        <td>
                            {{ App\Usulan::JENIS_USULAN_SELECT[$usulan->jenis_usulan] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.usulans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection