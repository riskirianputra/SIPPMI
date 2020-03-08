{{--<div class="sidebar">--}}
{{--    <nav class="sidebar-nav">--}}

{{--        <ul class="nav">--}}
{{--            <li class="nav-item">--}}
{{--                <a href="{{ route("admin.home") }}" class="nav-link">--}}
{{--                    <i class="nav-icon fas fa-fw fa-tachometer-alt">--}}

{{--                    </i>--}}
{{--                    {{ trans('global.dashboard') }}--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            @can('user_management_view')--}}
{{--                <li class="nav-item nav-dropdown">--}}
{{--                    <a class="nav-link  nav-dropdown-toggle" href="#">--}}
{{--                        <i class="fa-fw fas fa-users nav-icon">--}}

{{--                        </i>--}}
{{--                        {{ trans('cruds.userManagement.title') }}--}}
{{--                    </a>--}}
{{--                    <ul class="nav-dropdown-items">--}}
{{--                        @can('permission_view')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-unlock-alt nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.permission.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('role_view')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-briefcase nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.role.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('user_view')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-user nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.user.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('dosen_view')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.dosens.index") }}" class="nav-link {{ request()->is('admin/dosens') || request()->is('admin/dosens/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-user nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.dosen.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('staff_view')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.staff.index") }}" class="nav-link {{ request()->is('admin/staff') || request()->is('admin/staff/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-user nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.staff.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('audit_log_view')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.audit-logs.index") }}" class="nav-link {{ request()->is('admin/audit-logs') || request()->is('admin/audit-logs/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-file-alt nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.auditLog.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--            @endcan--}}
{{--            @can('user_alert_view')--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="{{ route("admin.user-alerts.index") }}" class="nav-link {{ request()->is('admin/user-alerts') || request()->is('admin/user-alerts/*') ? 'active' : '' }}">--}}
{{--                        <i class="fa-fw fas fa-bell nav-icon">--}}
<ul class="c-sidebar-nav">
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="index.html">
            <span class="c-sidebar-nav-icon">
                    <i class="cil-speedometer"></i>
                </span>
            Dashboard
        </a>
    </li>
    <li class="c-sidebar-nav-title">LPPM</li>
    @can('user_management_access')
        <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
                <span class="c-sidebar-nav-icon">
                    <i class="cil-user"></i>
                </span>
                Manajemen User</a>
            <ul class="c-sidebar-nav-dropdown-items">
                @can('permission_access')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ route('admin.permissions.index') }}"> Permissions</a>
                    </li>
                @endcan
                @can('role_access')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ route('admin.roles.index') }}"> Roles</a>
                    </li>
                @endcan
                @can('user_access')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ route('admin.users.index') }}"> Users</a>
                    </li>
                @endcan
                @can('dosen_access')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ route('admin.dosens.index') }}"> Dosen</a>
                    </li>
                @endcan
                @can('staff_access')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ route('admin.staff.index') }}"> Staff</a>
                    </li>
                @endcan
            </ul>
        </li>
    @endcan
    @can('audit_log_access')
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->is('admin/audit-logs') || request()->is('admin/audit-logs/*') ? 'active' : '' }}" href="{{ route("admin.audit-logs.index") }}">
                <span class="c-sidebar-nav-icon">
                    <i class="cil-bell"></i>
                </span>
                User Alert
            </a>
        </li>
    @endcan
    @can('manage_penelitian_user')
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->is('penelitians') || request()->is('penelitians/*') ? 'c-active' : '' }}" href="{{ route("penelitians.index") }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-school"></use>
                </svg>
                Penelitian
            </a>
        </li>
    @endcan

    @can('manage_pengabdian_user')
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->is('pengabdians') || request()->is('pengabdians/*') ? 'active' : '' }}" href="{{ route("pengabdians.index") }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-school"></use>
                </svg>
                Pengabdian
            </a>
        </li>
    @endcan

    @can('pengelolaan_penelitian_access')
        <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
                <span class="c-sidebar-nav-icon">
                    <i class="cil-school"></i>
                </span>
                {{ trans('cruds.pengelolaanPenelitian.title') }}</a>
            <ul class="c-sidebar-nav-dropdown-items">
                @can('penelitian_access')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link {{ request()->is('admin/penelitians') || request()->is('admin/penelitians/*') ? 'active' : '' }}" href="{{ route("admin.penelitians.index") }}">
                            {{ trans('cruds.penelitian.title') }}
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    @endcan

    @can('pengelolaan_pengabdian_access')
        <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
                <span class="c-sidebar-nav-icon">
                    <i class="cil-school"></i>
                </span>
                {{ trans('cruds.pengelolaanPengabdian.title') }}</a>
            <ul class="c-sidebar-nav-dropdown-items">
                @can('penelitian_access')
                    <li class="c-sidebar-nav-item">
                        <a href="{{ route("admin.pengabdians.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/pengabdians') || request()->is('admin/pengabdians/*') ? 'active' : '' }}">
                            {{ trans('cruds.pengabdian.title') }}
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    @endcan

</ul>
<button
    class="c-sidebar-minimizer c-class-toggler"
    type="button"
    data-target="_parent"
    data-class="c-sidebar-unfoldable"></button>




{{--            @can('referensi_access')--}}
{{--                <li class="nav-item nav-dropdown">--}}
{{--                    <a class="nav-link  nav-dropdown-toggle" href="#">--}}
{{--                        <i class="fa-fw fas fa-cogs nav-icon">--}}

{{--                        </i>--}}
{{--                        {{ trans('cruds.referensi.title') }}--}}
{{--                    </a>--}}
{{--                    <ul class="nav-dropdown-items">--}}
{{--                        @can('kode_rumpun_access')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.kode-rumpuns.index") }}" class="nav-link {{ request()->is('admin/kode-rumpuns') || request()->is('admin/kode-rumpuns/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-caret-right nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.kodeRumpun.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('fakultum_access')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.fakulta.index") }}" class="nav-link {{ request()->is('admin/fakulta') || request()->is('admin/fakulta/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-caret-right nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.fakultum.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('prodi_access')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.prodis.index") }}" class="nav-link {{ request()->is('admin/prodis') || request()->is('admin/prodis/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-caret-right nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.prodi.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('ref_skema_access')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.ref-skemas.index") }}" class="nav-link {{ request()->is('admin/ref-skemas') || request()->is('admin/ref-skemas/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-caret-right nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.refSkema.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('output_access')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.outputs.index") }}" class="nav-link {{ request()->is('admin/outputs') || request()->is('admin/outputs/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-caret-right nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.output.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('output_skema_access')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.output-skemas.index") }}" class="nav-link {{ request()->is('admin/output-skemas') || request()->is('admin/output-skemas/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-caret-right nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.outputSkema.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('penelitian_output_access')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.penelitian-outputs.index") }}" class="nav-link {{ request()->is('admin/penelitian-outputs') || request()->is('admin/penelitian-outputs/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-caret-right nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.penelitianOutput.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('pengabdian_output_access')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.pengabdian-outputs.index") }}" class="nav-link {{ request()->is('admin/pengabdian-outputs') || request()->is('admin/pengabdian-outputs/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-caret-right nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.pengabdianOutput.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--            @endcan--}}
{{--            @can('rencana_induk_access')--}}
{{--                <li class="nav-item nav-dropdown">--}}
{{--                    <a class="nav-link  nav-dropdown-toggle" href="#">--}}
{{--                        <i class="fa-fw fas fa-cogs nav-icon">--}}


{{--                        </i>--}}
{{--                        {{ trans('cruds.rencanaInduk.title') }}--}}
{{--                    </a>--}}
{{--                    <ul class="nav-dropdown-items">--}}
{{--                        @can('rip_tema_access')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.rip-temas.index") }}" class="nav-link {{ request()->is('admin/rip-temas') || request()->is('admin/rip-temas/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-cogs nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.ripTema.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('rip_sub_tema_access')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.rip-sub-temas.index") }}" class="nav-link {{ request()->is('admin/rip-sub-temas') || request()->is('admin/rip-sub-temas/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-cogs nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.ripSubTema.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('rip_topik_access')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.rip-topiks.index") }}" class="nav-link {{ request()->is('admin/rip-topiks') || request()->is('admin/rip-topiks/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-cogs nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.ripTopik.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('rip_sub_topik_access')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.rip-sub-topiks.index") }}" class="nav-link {{ request()->is('admin/rip-sub-topiks') || request()->is('admin/rip-sub-topiks/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-cogs nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.ripSubTopik.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('rip_tahapan_access')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.rip-tahapans.index") }}" class="nav-link {{ request()->is('admin/rip-tahapans') || request()->is('admin/rip-tahapans/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-cogs nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.ripTahapan.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--            @endcan--}}
{{--            @can('konfigurasi_access')--}}
{{--                <li class="nav-item nav-dropdown">--}}
{{--                    <a class="nav-link  nav-dropdown-toggle" href="#">--}}
{{--                        <i class="fa-fw fas fa-cogs nav-icon">--}}

{{--                        </i>--}}
{{--                        {{ trans('cruds.konfigurasi.title') }}--}}
{{--                    </a>--}}
{{--                    <ul class="nav-dropdown-items">--}}
{{--                        @can('komponen_biaya_access')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.komponen-biayas.index") }}" class="nav-link {{ request()->is('admin/komponen-biayas') || request()->is('admin/komponen-biayas/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-cogs nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.komponenBiaya.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('biaya_skema_access')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.biaya-skemas.index") }}" class="nav-link {{ request()->is('admin/biaya-skemas') || request()->is('admin/biaya-skemas/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-cogs nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.biayaSkema.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--            @endcan--}}
{{--            @can('konfigurasi_reviewer_access')--}}
{{--                <li class="nav-item nav-dropdown">--}}
{{--                    <a class="nav-link  nav-dropdown-toggle" href="#">--}}
{{--                        <i class="fa-fw fas fa-cogs nav-icon">--}}

{{--                        </i>--}}
{{--                        {{ trans('cruds.konfigurasiReviewer.title') }}--}}
{{--                    </a>--}}
{{--                    <ul class="nav-dropdown-items">--}}
{{--                        @can('reviewer_access')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.reviewers.index") }}" class="nav-link {{ request()->is('admin/reviewers') || request()->is('admin/reviewers/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-cogs nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.reviewer.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('tahapan_review_access')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.tahapan-reviews.index") }}" class="nav-link {{ request()->is('admin/tahapan-reviews') || request()->is('admin/tahapan-reviews/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-cogs nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.tahapanReview.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('penelitian_reviewer_access')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.penelitian-reviewers.index") }}" class="nav-link {{ request()->is('admin/penelitian-reviewers') || request()->is('admin/penelitian-reviewers/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-cogs nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.penelitianReviewer.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--            @endcan--}}
{{--            <li class="nav-item">--}}
{{--                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">--}}
{{--                    <i class="nav-icon fas fa-fw fa-sign-out-alt">--}}

{{--                    </i>--}}
{{--                    {{ trans('global.logout') }}--}}
{{--                </a>--}}
{{--            </li>--}}


{{--        </ul>--}}

{{--    </nav>--}}
{{--    <button class="sidebar-minimizer brand-minimizer" type="button"></button>--}}
{{--</div>--}}

{{--            @can('prn_fokus_view')--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="{{ route("prn-fokus.index") }}" class="nav-link {{ request()->is('prn-fokus') || request()->is('prn-fokus/*') ? 'active' : '' }}">--}}
{{--                        <i class="fa-fw fas fa-cogs nav-icon">--}}

{{--                        </i>--}}
{{--                        Prn Fokus--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            @endcan--}}
{{--            @can('penelitian_user_manage')--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="{{ route("penelitians.index") }}" class="nav-link {{ request()->is('penelitians') || request()->is('penelitians/*') ? 'active' : '' }}">--}}
{{--                        <i class="fa-fw fas fa-cogs nav-icon">--}}

{{--                        </i>--}}
{{--                        Penelitian--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            @endcan--}}

{{--            @can('pengabdian_user_manage')--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="{{ route("pengabdians.index") }}" class="nav-link {{ request()->is('pengabdians') || request()->is('pengabdians/*') ? 'active' : '' }}">--}}
{{--                        <i class="fa-fw fas fa-cogs nav-icon">--}}

{{--                        </i>--}}
{{--                        Pengabdian--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            @endcan--}}

{{--            @can('pengelolaan_penelitian_view')--}}
{{--                <li class="nav-item nav-dropdown">--}}
{{--                    <a class="nav-link  nav-dropdown-toggle" href="#">--}}
{{--                        <i class="fa-fw fas fa-address-card nav-icon">--}}

{{--                        </i>--}}
{{--                        {{ trans('cruds.pengelolaanPenelitian.title') }}--}}
{{--                    </a>--}}
{{--                    <ul class="nav-dropdown-items">--}}
{{--                        @can('penelitian_view')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.penelitians.index") }}" class="nav-link {{ request()->is('admin/penelitians') || request()->is('admin/penelitians/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-caret-right nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.penelitian.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('penelitian_anggotum_view')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.penelitian-anggota.index") }}" class="nav-link {{ request()->is('admin/penelitian-anggota') || request()->is('admin/penelitian-anggota/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-caret-right nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.penelitianAnggotum.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('penelitian_biaya_view')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.penelitian-biayas.index") }}" class="nav-link {{ request()->is('admin/penelitian-biayas') || request()->is('admin/penelitian-biayas/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-cogs nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.penelitianBiaya.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--            @endcan--}}
{{--            @can('pengelolaan_pengabdian_view')--}}
{{--                <li class="nav-item nav-dropdown">--}}
{{--                    <a class="nav-link  nav-dropdown-toggle" href="#">--}}
{{--                        <i class="fa-fw far fa-address-card nav-icon">--}}

{{--                        </i>--}}
{{--                        {{ trans('cruds.pengelolaanPengabdian.title') }}--}}
{{--                    </a>--}}
{{--                    <ul class="nav-dropdown-items">--}}
{{--                        @can('pengabdian_view')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.pengabdians.index") }}" class="nav-link {{ request()->is('admin/pengabdians') || request()->is('admin/pengabdians/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-caret-right nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.pengabdian.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('pengabdian_anggotum_view')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.pengabdian-anggota.index") }}" class="nav-link {{ request()->is('admin/pengabdian-anggota') || request()->is('admin/pengabdian-anggota/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-caret-right nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.pengabdianAnggotum.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('pengabdian_biaya_view')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.pengabdian-biayas.index") }}" class="nav-link {{ request()->is('admin/pengabdian-biayas') || request()->is('admin/pengabdian-biayas/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-cogs nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.pengabdianBiaya.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--            @endcan--}}
{{--            @can('referensi_view')--}}
{{--                <li class="nav-item nav-dropdown">--}}
{{--                    <a class="nav-link  nav-dropdown-toggle" href="#">--}}
{{--                        <i class="fa-fw fas fa-cogs nav-icon">--}}

{{--                        </i>--}}
{{--                        {{ trans('cruds.referensi.title') }}--}}
{{--                    </a>--}}
{{--                    <ul class="nav-dropdown-items">--}}
{{--                        @can('kode_rumpun_view')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.kode-rumpuns.index") }}" class="nav-link {{ request()->is('admin/kode-rumpuns') || request()->is('admin/kode-rumpuns/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-caret-right nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.kodeRumpun.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('fakultum_view')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.fakulta.index") }}" class="nav-link {{ request()->is('admin/fakulta') || request()->is('admin/fakulta/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-caret-right nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.fakultum.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('prodi_view')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.prodis.index") }}" class="nav-link {{ request()->is('admin/prodis') || request()->is('admin/prodis/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-caret-right nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.prodi.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('ref_skema_view')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.ref-skemas.index") }}" class="nav-link {{ request()->is('admin/ref-skemas') || request()->is('admin/ref-skemas/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-caret-right nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.refSkema.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('penelitian_output_view')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.penelitian-outputs.index") }}" class="nav-link {{ request()->is('admin/penelitian-outputs') || request()->is('admin/penelitian-outputs/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-caret-right nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.penelitianOutput.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('pengabdian_output_view')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.pengabdian-outputs.index") }}" class="nav-link {{ request()->is('admin/pengabdian-outputs') || request()->is('admin/pengabdian-outputs/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-caret-right nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.pengabdianOutput.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--            @endcan--}}
{{--            @can('rencana_induk_view')--}}
{{--                <li class="nav-item nav-dropdown">--}}
{{--                    <a class="nav-link  nav-dropdown-toggle" href="#">--}}
{{--                        <i class="fa-fw fas fa-cogs nav-icon">--}}

{{--                        </i>--}}
{{--                        {{ trans('cruds.rencanaInduk.title') }}--}}
{{--                    </a>--}}
{{--                    <ul class="nav-dropdown-items">--}}
{{--                        @can('rip_tema_view')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.rip-temas.index") }}" class="nav-link {{ request()->is('admin/rip-temas') || request()->is('admin/rip-temas/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-cogs nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.ripTema.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('rip_sub_tema_view')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.rip-sub-temas.index") }}" class="nav-link {{ request()->is('admin/rip-sub-temas') || request()->is('admin/rip-sub-temas/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-cogs nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.ripSubTema.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('rip_topik_view')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.rip-topiks.index") }}" class="nav-link {{ request()->is('admin/rip-topiks') || request()->is('admin/rip-topiks/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-cogs nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.ripTopik.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('rip_sub_topik_view')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.rip-sub-topiks.index") }}" class="nav-link {{ request()->is('admin/rip-sub-topiks') || request()->is('admin/rip-sub-topiks/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-cogs nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.ripSubTopik.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('rip_tahapan_view')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.rip-tahapans.index") }}" class="nav-link {{ request()->is('admin/rip-tahapans') || request()->is('admin/rip-tahapans/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-cogs nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.ripTahapan.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--            @endcan--}}
{{--            @can('konfigurasi_view')--}}
{{--                <li class="nav-item nav-dropdown">--}}
{{--                    <a class="nav-link  nav-dropdown-toggle" href="#">--}}
{{--                        <i class="fa-fw fas fa-cogs nav-icon">--}}

{{--                        </i>--}}
{{--                        {{ trans('cruds.konfigurasi.title') }}--}}
{{--                    </a>--}}
{{--                    <ul class="nav-dropdown-items">--}}
{{--                        @can('komponen_biaya_view')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.komponen-biayas.index") }}" class="nav-link {{ request()->is('admin/komponen-biayas') || request()->is('admin/komponen-biayas/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-cogs nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.komponenBiaya.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('biaya_skema_view')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.biaya-skemas.index") }}" class="nav-link {{ request()->is('admin/biaya-skemas') || request()->is('admin/biaya-skemas/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-cogs nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.biayaSkema.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--            @endcan--}}
{{--            @can('konfigurasi_reviewer_view')--}}
{{--                <li class="nav-item nav-dropdown">--}}
{{--                    <a class="nav-link  nav-dropdown-toggle" href="#">--}}
{{--                        <i class="fa-fw fas fa-cogs nav-icon">--}}

{{--                        </i>--}}
{{--                        {{ trans('cruds.konfigurasiReviewer.title') }}--}}
{{--                    </a>--}}
{{--                    <ul class="nav-dropdown-items">--}}
{{--                        @can('reviewer_view')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.reviewers.index") }}" class="nav-link {{ request()->is('admin/reviewers') || request()->is('admin/reviewers/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-cogs nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.reviewer.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('tahapan_review_view')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.tahapan-reviews.index") }}" class="nav-link {{ request()->is('admin/tahapan-reviews') || request()->is('admin/tahapan-reviews/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-cogs nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.tahapanReview.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                        @can('penelitian_reviewer_view')--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route("admin.penelitian-reviewers.index") }}" class="nav-link {{ request()->is('admin/penelitian-reviewers') || request()->is('admin/penelitian-reviewers/*') ? 'active' : '' }}">--}}
{{--                                    <i class="fa-fw fas fa-cogs nav-icon">--}}

{{--                                    </i>--}}
{{--                                    {{ trans('cruds.penelitianReviewer.title') }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endcan--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--            @endcan--}}
{{--            <li class="nav-item">--}}
{{--                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">--}}
{{--                    <i class="nav-icon fas fa-fw fa-sign-out-alt">--}}

{{--                    </i>--}}
{{--                    {{ trans('global.logout') }}--}}
{{--                </a>--}}
{{--            </li>--}}


{{--        </ul>--}}

{{--    </nav>--}}
{{--    <button class="sidebar-minimizer brand-minimizer" type="button"></button>--}}
{{--</div>--}}
