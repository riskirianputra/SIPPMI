@extends('layouts.admin')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => url('home'),
        'Penelitian' => '#'
    ]) !!}
@endsection

@section('toolbar')
    @can('penelitian_user_manage')
        {!! cui_toolbar_btn(route('penelitians.create'), 'icon-plus', 'Tambah Usulan Penelitian') !!}
    @endcan
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <strong>Daftar Usulan Penelitian</strong>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-responsive-sm">
                    <thead>
                    <tr>
                        <th class="text-center">
                            {{ trans('cruds.penelitian.fields.judul') }}
                            <br>
                            {{ trans('cruds.penelitian.fields.skema') }}
                        </th >
                        <th class="text-center">
                            {{ trans('cruds.penelitian.fields.biaya') }}
                            <br>
                            (Rp)
                        </th>
                        <th class="text-center">
                            Proposal
                        </th>
                        <th class="text-center">
                            CV
                        </th>
                        <th class="text-center">
                            Lembaran<br>Pengesahan
                        </th>
                        <th class="text-center">
                            Status<br>Penelitian
                        </th>
                        <th class="text-center">
                            &nbsp;Aksi
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($penelitians as $key => $penelitian)
                        <tr data-entry-id="{{ $penelitian->id }}" @if($penelitian->hasKomentar())class="bg-warning" @endif>
                            <td>
                                {!! $penelitian->judulSimple ?? '' !!}
                                <br>
                                <span class="text-info">
                                    <small><em>{{ $penelitian->skema->nama ?? '' }}</em></small>
                                </span>
                            </td>
                            <td class="text-right">
                                {{ number_format($penelitian->biaya,0, ',', '.').',-' ?? '' }}
                            </td>
                            <td class="text-center">
                                @if(!empty($penelitian->file_proposal))
                                    <a href="{{ $penelitian->getFileProposalPath() }}" target="_blank">
                                        <i class="fa fa-file-pdf-o text-danger"></i>
                                    </a>
                                @endif
                            </td>
                            <td class="text-center">
                                @if(!empty($penelitian->file_cv))
                                    <a href="{{ $penelitian->getFileCvPath() }}" target="_blank">
                                        <i class="fa fa-file-pdf-o text-danger"></i>
                                    </a>
                                @endif

                            </td>
                            <td class="text-center">
                                @if(!empty($penelitian->file_pengesahan))
                                    <a href="{{ $penelitian->getFilePengesahanPath() }}" target="_blank">
                                        <i class="fa fa-file-pdf-o text-danger"></i>
                                    </a>
                                @endif

                            </td>
                            <td class="text-center">
                                <h5>
                                    <span class="badge badge-{!! $penelitian->statusTextColor !!}">
                                       {{ $penelitian->statusText }}
                                    </span>
                                </h5>
                            </td>
                            <td class="text-center">
                                {!! cui()->btn_view(route('penelitians.show', $penelitian->id)) !!}
                                @if($penelitian->owner == auth()->user()->id)
                                    {!! cui()->btn_edit(route('penelitians.edit', $penelitian->id)) !!}
                                    {!! cui()->btn_delete(route('penelitians.destroy', $penelitian->id), trans('global.areYouSure')) !!}
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                <h5>Belum ada data usulan penelitian</h5>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

@endsection
