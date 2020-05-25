@extends('layouts.admin')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => url('home'),
        'Kinerja' => '#'
    ]) !!}
@endsection

@section('toolbar')
    @can('kinerja_user_manage')
        {!! cui_toolbar_btn(route('pemakalahs.create'), 'cil-plus', 'Tambah Artikel Seminar') !!}
    @endcan
@endsection

@section('content')

    <div class="card">
        <div class="card-header font-weight-bold">
            Daftar Makalah Seminar Ilmiah
        </div>

        <div class="card-body">
            <table
                class=" table table-outline table-striped table-hover datatable datatable-makalah"
                style="width: 100%"
            >
                <thead class="thead-light">
                <tr>
                    <th>Judul</th>
                    <th>Penyelenggara</th>
                    <th>Status</th>
                    <th>Berkas</th>
                    <th class="text-center"><i class="cil-options"></i></th>
                </tr>
                </thead>
                <tbody>
                @forelse($makalahs as $makalah)
                    <tr>
                        <td>{!! $makalah->judulSimple ?? "" !!}</td>
                        <td>
                            {{ $makalah->penyelenggara }}<br>
                            {{ $makalah->tempat }}, {{ $makalah->tanggal_mulai }} s/d {{ $makalah->tanggal_selesai }}
                        </td>
                        <td>
                            {{ $makalah->status_pemakalah_text }}
                        </td>
                        <td>
                            @if(!empty($makalah->file_artikel))
                                <a href="{{ $makalah->getFileArtikelUrl() }}" target="_blank">
                                    <i class="fa fa-file-pdf-o text-danger"></i>
                                </a>
                            @endif
                        </td>
                        <td class="text-center">
                            {!! cui()->btn_view(route('pemakalahs.show', $makalah->id)) !!}
                            @if($makalah->owner == auth()->user()->id)
                                {!! cui()->btn_edit(route('pemakalahs.edit', $makalah->id)) !!}
                                {!! cui()->btn_delete(route('pemakalahs.destroy', $makalah->id), trans('global.areYouSure')) !!}
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <h5>Belum ada artikel</h5>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
