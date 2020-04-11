<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-md-down-none">
        <svg class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="assets/brand/coreui-pro.svg#full"></use>
        </svg>
        <svg class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
            <use xlink:href="assets/brand/coreui-pro.svg#signet"></use>
        </svg>
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
        @can('audit_log_view')
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ request()->is('admin/audit-logs') || request()->is('admin/audit-logs/*') ? 'active' : '' }}"
                   href="{{ route("admin.audit-logs.index") }}">
                <span class="c-sidebar-nav-icon">
                    <i class="cil-bell"></i>
                </span>
                    User Alert
                </a>
            </li>
        @endcan
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

        @can('monitoring')
            <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
                <span class="c-sidebar-nav-icon">
                    <i class="cil-filter"></i>
                </span>
                    Monitoring</a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('penelitian_view')
                        <li class="c-sidebar-nav-item">
                            <a class="c-sidebar-nav-link {{ request()->is('admin/penelitians') || request()->is('admin/penelitians/*') ? 'active' : '' }}"
                               href="{{ route("admin.proposal-monitor.dosen-index") }}">
                                Monitoring Proposal
                            </a>
                        </li>
                    @endcan
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
        class="c-sidebar-minimizer c-class-toggler"
        type="button"
        data-target="_parent"
        data-class="c-sidebar-unfoldable"></button>


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

</div>
