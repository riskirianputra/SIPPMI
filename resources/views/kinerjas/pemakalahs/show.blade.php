@extends('layouts.admin')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => url('home'),
        'Kinerja' => route('pemakalahs.index'),
        'Pemakalah' => route('pemakalahs.index'),
        'Tambah' => '#'
    ]) !!}
@endsection

@section('toolbar')
    {!! cui_toolbar_btn(route('pemakalahs.index'), 'cil-list', 'List Makalah') !!}
@endsection

@section('content')

    <div class="card">
        <div class="card-header font-weight-bold">Detail Makalah</div>

        <div class="card-body">
            <!-- Static Field for Judul -->
            <div class="form-group">
                <div class="form-label">Judul</div>
                <div>{{ $makalah->judulSimple }}</div>
            </div>

            <!-- Static Field for Tahun -->
            <div class="form-group">
                <div class="form-label">Tahun</div>
                <div>{{ $makalah->tahun }}</div>
            </div>

            <!-- Static Field for Nama Forum -->
            <div class="form-group">
                <div class="form-label">Nama Forum</div>
                <div>{{ $makalah->nama_forum }}</div>
            </div>

            <!-- Static Field for Status Pemakalah -->
            <div class="form-group">
                <div class="form-label">Status Pemakalah</div>
                <div>{{ $makalah->status_pemakalah_text }}</div>
            </div>

            <!-- Static Field for Tingkat -->
            <div class="form-group">
                <div class="form-label">Tingkat</div>
                <div>{{ $makalah->tingkat_text }}</div>
            </div>

            <!-- Static Field for Penyelenggara -->
            <div class="form-group">
                <div class="form-label">Penyelenggara</div>
                <div>{{ $makalah->penyelenggara }}</div>
            </div>

            <!-- Static Field for Waktu & Tempat -->
            <div class="form-group">
                <div class="form-label">Waktu & Tempat</div>
                <div>{{ $makalah->tempat }}, {{ $makalah->tanggal_mulai }} s/d {{ $makalah->tanggal_selesai }}</div>
            </div>

            <!-- Static Field for File Artikel -->
            <div class="form-group">
                <div class="form-label">File Artikel</div>
                <div>
                    @if(isset($makalah) && !empty($makalah->file_artikel))
                        <a href="{{ $makalah->getFileArtikelUrl() ?? '' }}" target="_blank">
                            <i class="fa fa-file-pdf text-danger"></i>
                            Download
                        </a>
                    @endif
                </div>
            </div>

            <!-- Static Field for Penulis -->
            <div class="form-group">
                <div class="form-label">Penulis</div>
                <div>
                    @include('pemakalahs.anggota._mahasiswa')
                </div>
            </div>

        </div>
    </div>

@endsection
