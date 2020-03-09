@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'User' => route('admin.users.index'),
        'Detail' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('user_manage')
        {!! cui_toolbar_btn(route('admin.users.create'), 'icon-plus', trans('global.add').' '.trans('cruds.user.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.users.edit',[$user->id]), 'icon-pencil', trans('global.edit').' '.trans('cruds.user.title_singular') ) !!}
        {!! cui_toolbar_btn(route('admin.users.destroy',[$user->id]), 'icon-trash', trans('global.delete').' '.trans('cruds.user.title_singular') ) !!}
    @endcan
@stop
@section('content')

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.show') }} {{ trans('cruds.user.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.username') }}
                        </th>
                        <td>
                            {{ $user->username }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email_verified_at') }}
                        </th>
                        <td>
                            {{ $user->email_verified_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <td>
                            @foreach($user->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.type') }}
                        </th>
                        <td>
                            {{ App\User::TYPE_SELECT[$user->type] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

{{--<div class="card">--}}
{{--    <div class="card-header">--}}
{{--        {{ trans('global.relatedData') }}--}}
{{--    </div>--}}
{{--    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="#created_by_penelitians" role="tab" data-toggle="tab">--}}
{{--                {{ trans('cruds.penelitian.title') }}--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="#pengusul_usulans" role="tab" data-toggle="tab">--}}
{{--                {{ trans('cruds.usulan.title') }}--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="#created_by_pengabdians" role="tab" data-toggle="tab">--}}
{{--                {{ trans('cruds.pengabdian.title') }}--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="#user_user_alerts" role="tab" data-toggle="tab">--}}
{{--                {{ trans('cruds.userAlert.title') }}--}}
{{--            </a>--}}
{{--        </li>--}}
{{--    </ul>--}}
{{--    <div class="tab-content">--}}
{{--        <div class="tab-pane" role="tabpanel" id="created_by_penelitians">--}}
{{--            @includeIf('admin.users.relationships.createdByPenelitians', ['penelitians' => $user->createdByPenelitians])--}}
{{--        </div>--}}
{{--        <div class="tab-pane" role="tabpanel" id="pengusul_usulans">--}}
{{--            @includeIf('admin.users.relationships.pengusulUsulans', ['usulans' => $user->pengusulUsulans])--}}
{{--        </div>--}}
{{--        <div class="tab-pane" role="tabpanel" id="created_by_pengabdians">--}}
{{--            @includeIf('admin.users.relationships.createdByPengabdians', ['pengabdians' => $user->createdByPengabdians])--}}
{{--        </div>--}}
{{--        <div class="tab-pane" role="tabpanel" id="user_user_alerts">--}}
{{--            @includeIf('admin.users.relationships.userUserAlerts', ['userAlerts' => $user->userUserAlerts])--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

@endsection
