@extends('layouts.admin')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => url('home'),
        'Pengabdian' => '#'
    ]) !!}
@endsection

@section('toolbar')
    @can('pengabdian_user_manage')
        {!! cui_toolbar_btn(route('pengabdians.create'), 'icon-plus', 'Tambah Usulan pengabdian') !!}
    @endcan
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <strong>Daftar Usulan pengabdian</strong>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-responsive-sm">
                    <thead>
                    <tr>
                        <th class="text-center">
                            {{ trans('cruds.pengabdian.fields.judul') }}
                            <br>
                            {{ trans('cruds.pengabdian.fields.skema') }}
                        </th >
                        <th class="text-center">
                            {{ trans('cruds.pengabdian.fields.biaya') }}
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
                            Status<br>pengabdian
                        </th>
                        <th class="text-center">
                            &nbsp;Aksi
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($pengabdians as $key => $pengabdian)
                        <tr data-entry-id="{{ $pengabdian->id }}" @if($pengabdian->hasKomentar())class="bg-warning" @endif>
                            <td>
                                {!! $pengabdian->judulSimple ?? '' !!}
                                <br>
                                <span class="text-info">
                                    <small><em>{{ $pengabdian->skema->nama ?? '' }}</em></small>
                                </span>
                            </td>
                            <td class="text-right">
                                {{ number_format($pengabdian->biaya,0, ',', '.').',-' ?? '' }}
                            </td>
                            <td class="text-center">
                                @if(!empty($pengabdian->file_proposal))
                                    <a href="{{ $pengabdian->getFileProposalPath() }}" target="_blank">
                                        <i class="fa fa-file-pdf-o text-danger"></i>
                                    </a>
                                @endif
                            </td>
                            <td class="text-center">
                                @if(!empty($pengabdian->file_cv))
                                    <a href="{{ $pengabdian->getFileCvPath() }}" target="_blank">
                                        <i class="fa fa-file-pdf-o text-danger"></i>
                                    </a>
                                @endif

                            </td>
                            <td class="text-center">
                                @if(!empty($pengabdian->file_pengesahan))
                                    <a href="{{ $pengabdian->getFilePengesahanPath() }}" target="_blank">
                                        <i class="fa fa-file-pdf-o text-danger"></i>
                                    </a>
                                @endif

                            </td>
                            <td class="text-center">
                                <h5>
                                    <span class="badge badge-{!! $pengabdian->statusTextColor !!}">
                                       {{ $pengabdian->statusText }}
                                    </span>
                                </h5>

                            </td>
                            <td class="text-center">
                                {!! cui()->btn_view(route('pengabdians.show', $pengabdian->id)) !!}
                                @if($pengabdian->owner == auth()->user()->id)
                                    {!! cui()->btn_edit(route('pengabdians.edit', $pengabdian->id)) !!}
                                    {!! cui()->btn_delete(route('pengabdians.destroy', $pengabdian->id), trans('global.areYouSure')) !!}
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                <h5>Belum ada data usulan pengabdian</h5>
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
