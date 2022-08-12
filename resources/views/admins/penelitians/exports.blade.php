<table class="table table-dark table-outline">
    <thead>
    <tr>
        <th>No</th>
        <th>NIDN</th>
        <th>Ketua</th>
        <th>Anggota</th>
        <th>Mahasiswa</th>
        <th>Judul</th>
        <th>Skema</th>
        <th>Biaya</th>
        <th>Fakultas</th>
        <th>Prodi</th>
        <th>Bidang Fokus</th>
        <th>Proposal</th>
        <th>CV</th>
        <th>Lembar Pengesahan</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($penelitians as $penelitian)
        @php
            $ketua = $penelitian->ketua[0];
        @endphp
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ optional($ketua)->nidn }}</td>
            <td>{{ optional($ketua)->nama }}</td>
            <td>
                @if($penelitian->anggota_dosens)
                    @foreach($penelitian->anggota_dosens as $anggota)
                        {{ $anggota->nama }} /{{ $anggota->nidn }}<br>
                    @endforeach
                @endif
            </td>
            <td>
                @if($penelitian->anggota_mahasiswas)
                    @foreach($penelitian->anggota_mahasiswas as $anggota)
                        {{ $anggota->nama }} /{{ $anggota->nidn }}<br>
                    @endforeach
                @endif
            </td>
            <td>{{ $penelitian->judul_text }}</td>
            <td>{{ optional($penelitian->skema)->nama }}</td>
            <td>{{ $penelitian->biaya }}</td>
            <td>{{ optional($ketua->dosen->prodi)->fakultas->nama }}</td>
            <td>{{ optional($ketua->dosen->prodi)->nama }}</td>
            <td>{{ optional($penelitian->fokus)->nama }}</td>
            <td>
                @if(!empty($penelitian->file_proposal))
                    OK
                @endif
            </td>
            <td>
                @if(!empty($penelitian->file_cv))
                    OK
                @endif
            </td>
            <td>
                @if(!empty($penelitian->file_pengesahan))
                    OK
                @endif
            </td>
            <td>{{ $penelitian->status_text }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
