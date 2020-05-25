<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">

    <div class="c-sidebar-brand">
        <img class="c-sidebar-brand-full" src="{{ asset('assets/brand/coreui-pro-base-white.svg') }}" width="118"
             height="46" alt="CoreUI Logo">
        <img class="c-sidebar-brand-minimized" src="{{ asset('assets/brand/coreui-signet-white.svg') }}" width="118"
             height="46" alt="CoreUI Logo">
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ url('/home') }}">
            <span class="c-sidebar-nav-icon">
                    <i class="cil-speedometer"></i>
                </span>
                Dashboard
            </a>
        </li>
        <li class="c-sidebar-nav-title">LPPM</li>
        @can('user_management_view')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <span class="c-sidebar-nav-icon">
                    <i class="cil-user"></i>
                </span>
                    Manajemen User
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_view')
                        <li class="c-sidebar-nav-item">
                            <a class="c-sidebar-nav-link" href="{{ route('admin.permissions.index') }}"> Permissions</a>
                        </li>
                    @endcan
                    @can('role_view')
                        <li class="c-sidebar-nav-item">
                            <a class="c-sidebar-nav-link" href="{{ route('admin.roles.index') }}"> Roles</a>
                        </li>
                    @endcan
                    @can('user_view')
                        <li class="c-sidebar-nav-item">
                            <a class="c-sidebar-nav-link" href="{{ route('admin.users.index') }}"> Users</a>
                        </li>
                    @endcan
                    @can('dosen_view')
                        <li class="c-sidebar-nav-item">
                            <a class="c-sidebar-nav-link" href="{{ route('admin.dosens.index') }}"> Dosen</a>
                        </li>
                    @endcan
                    @can('staff_view')
                        <li class="c-sidebar-nav-item">
                            <a class="c-sidebar-nav-link" href="{{ route('admin.staff.index') }}"> Staff</a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
{{--        @can('audit_log_view')--}}
{{--            <li class="c-sidebar-nav-item">--}}
{{--                <a class="c-sidebar-nav-link {{ request()->is('admin/audit-logs') || request()->is('admin/audit-logs/*') ? 'active' : '' }}"--}}
{{--                   href="{{ route("admin.audit-logs.index") }}">--}}
{{--                <span class="c-sidebar-nav-icon">--}}
{{--                    <i class="cil-bell"></i>--}}
{{--                </span>--}}
{{--                    User Alert--}}
{{--                </a>--}}
{{--            </li>--}}
{{--        @endcan--}}
        @can('penelitian_user_manage')
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->is('penelitians') || request()->is('penelitians/*') ? 'c-active' : '' }}"
                   href="{{ route("penelitians.index") }}">
                <span class="c-sidebar-nav-icon">
                    <i class="cil-school"></i>
                </span>
                    Penelitian
                </a>
            </li>
        @endcan

        @can('pengabdian_user_manage')
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->is('pengabdians') || request()->is('pengabdians/*') ? 'active' : '' }}"
                   href="{{ route("pengabdians.index") }}">
                <span class="c-sidebar-nav-icon">
                    <i class="cil-school"></i>
                </span>
                    Pengabdian
                </a>
            </li>
        @endcan

        @can('kinerja_user_manage')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <span class="c-sidebar-nav-icon">
                    <i class="cil-user"></i>
                </span>
                    Kinerja
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ route('pemakalahs.index') }}"> Pemakalah Forum Ilmiah</a>
                    </li>
                </ul>
            </li>
        @endcan

        @can('pengelolaan_penelitian_view')
            <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
                <span class="c-sidebar-nav-icon">
                    <i class="cil-school"></i>
                </span>
                    {{ trans('cruds.pengelolaanPenelitian.title') }}</a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('penelitian_view')
                        <li class="c-sidebar-nav-item">
                            <a class="c-sidebar-nav-link {{ request()->is('admin/penelitians') || request()->is('admin/penelitians/*') ? 'active' : '' }}"
                               href="{{ route("admin.penelitians.index") }}">
                                {{ trans('cruds.penelitian.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        @can('pengelolaan_pengabdian_view')
            <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
                <span class="c-sidebar-nav-icon">
                    <i class="cil-school"></i>
                </span>
                    {{ trans('cruds.pengelolaanPengabdian.title') }}</a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('pengabdian_view')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.pengabdians.index") }}"
                               class="c-sidebar-nav-link {{ request()->is('admin/pengabdians') || request()->is('admin/pengabdians/*') ? 'active' : '' }}">
                                {{ trans('cruds.pengabdian.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        @can('kinerja_view')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <span class="c-sidebar-nav-icon">
                    <i class="cil-school"></i>
                </span>
                    Kinerja
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <a href="{{ route("admin.pemakalahs.index") }}"
                           class="c-sidebar-nav-link {{ request()->is('admin/pemakalahs') || request()->is('admin/pemakalahs/*') ? 'active' : '' }}"
                        >
                            Pemakalah
                        </a>
                    </li>
                </ul>
            </li>
        @endcan

        @can('monitoring')
            <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
                <span class="c-sidebar-nav-icon">
                    <i class="cil-filter"></i>
                </span>
                    Monitoring</a>
                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link {{ request()->is('admin/penelitians') || request()->is('admin/penelitians/*') ? 'active' : '' }}"
                           href="{{ route("admin.proposal-monitor.dosen-index") }}">
                            Monitoring Proposal
                        </a>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link {{ request()->is('admin.monitoring-reviews') || request()->is('admin.monitoring-reviews/*') ? 'active' : '' }}"
                           href="{{ route("admin.monitoring-reviews.progress") }}">
                            Monitoring Review
                        </a>
                    </li>
                </ul>
            </li>
        @endcan

        @can('reviewer_view')
            <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
                <span class="c-sidebar-nav-icon">
                    <i class="cil-3d"></i>
                </span>Manajemen Review
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('reviewer_view')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.reviewers.index") }}"
                               class="c-sidebar-nav-link {{ request()->is('admin/reviewers') || request()->is('admin/reviewers/*') ? 'active' : '' }}">
                                {{ trans('cruds.reviewer.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('plotting_reviewer_view')
                        <li class="c-sidebar-nav-item">
                            <a href="{!! route('admin.plotting-reviewers.index') !!}"
                               class="c-sidebar-nav-link {{ request()->is('admin/plotting-reviewers') || request()->is('admin/plotting-reviewers/*') ? 'active' : '' }}">
                                {{ trans('cruds.plottingReviewer.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('tahapan_review_view')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tahapan-reviews.index") }}"
                               class="c-sidebar-nav-link {{ request()->is('admin/tahapan-reviews') || request()->is('admin/tahapan-reviews/*') ? 'active' : '' }}">
                                {{ trans('cruds.tahapanReview.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan


        @can('review')
            <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
                <span class="c-sidebar-nav-icon">
                    <i class="cil-3d"></i>
                </span>Review Usulan
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <a href="{{ route("review-penelitians.index") }}"
                           class="c-sidebar-nav-link {{ request()->is('review-penelitians.index') || request()->is('review-penelitians/*') ? 'active' : '' }}">
                            Penelitian
                        </a>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <a href="{!! route('review-pengabdians.index') !!}"
                           class="c-sidebar-nav-link {{ request()->is('review-pengabdians.index') || request()->is('review-pengabdians/*') ? 'active' : '' }}">
                            Pengabdian
                        </a>
                    </li>
                </ul>
            </li>
        @endcan

        @can('referensi_view')
            <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
                <span class="c-sidebar-nav-icon">
                    <i class="cil-3d"></i>
                </span>Referensi
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('kode_rumpun_view')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.kode-rumpuns.index") }}"
                               class="c-sidebar-nav-link {{ request()->is('admin/kode-rumpuns') || request()->is('admin/kode-rumpuns/*') ? 'active' : '' }}">
                                {{ trans('cruds.kodeRumpun.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('fakultum_view')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.fakulta.index") }}"
                               class="c-sidebar-nav-link {{ request()->is('admin/fakulta') || request()->is('admin/fakulta/*') ? 'active' : '' }}">
                                {{ trans('cruds.fakultum.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('prodi_view')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.prodis.index") }}"
                               class="c-sidebar-nav-link {{ request()->is('admin/prodis') || request()->is('admin/prodis/*') ? 'active' : '' }}">
                                {{ trans('cruds.prodi.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('ref_skema_view')
                        <li class="nav-item">
                            <a href="{{ route("admin.ref-skemas.index") }}"
                               class="c-sidebar-nav-link {{ request()->is('admin/ref-skemas') || request()->is('admin/ref-skemas/*') ? 'active' : '' }}">
                                {{ trans('cruds.refSkema.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('prn_fokus_view')
                        <li class="nav-item">
                            <a href="{{ route("prn-fokus.index") }}"
                               class="c-sidebar-nav-link {{ request()->is('prn-fokus') || request()->is('prn-fokus/*') ? 'active' : '' }}">
                                Bidang Fokus
                            </a>
                        </li>
                    @endcan
                    @can('output_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.outputs.index") }}"
                               class="c-sidebar-nav-link {{ request()->is('admin/outputs') || request()->is('admin/outputs/*') ? 'active' : '' }}">
                                {{ trans('cruds.output.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan


    </ul>

    <button
        class="c-sidebar-minimizer
        c-class-toggler"
        type="button"
        data-target="_parent"
        data-class="c-sidebar-unfoldable">
    </button>
</div>
