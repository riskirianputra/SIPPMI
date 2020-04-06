<table class="table table-dark table-outline">
    <thead>
    <tr>
        <th>No</th>
        <th>NIDN</th>
        <th>Ketua</th>
        <th>Anggota</th>
        <th>Mahasiswa</th>
        <th>Judul</th>
        <th>Mitra</th>
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
    @foreach($pengabdians as $pengabdian)
        @php
            $ketua = $pengabdian->ketua[0];
        @endphp
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ optional($ketua)->nidn }}</td>
            <td>{{ optional($ketua)->nama }}</td>
            <td>
                @if($pengabdian->anggota_dosens)
                    @foreach($pengabdian->anggota_dosens as $anggota)
                        {{ $anggota->nama }} /{{ $anggota->nidn }}<br>
                    @endforeach
                @endif
            </td>
            <td>
                @if($pengabdian->anggota_mahasiswas)
                    @foreach($pengabdian->anggota_mahasiswas as $anggota)
                        {{ $anggota->nama }} /{{ $anggota->nidn }}<br>
                    @endforeach
                @endif
            </td>
            <td>{{ $pengabdian->judul_text }}</td>
            <td>{{ $pengabdian->mitra_pengabdian }}</td>
            <td>{{ optional($pengabdian->skema)->nama }}</td>
            <td>{{ $pengabdian->biaya }}</td>
            <td>{{ optional($ketua->dosen->prodi)->fakultas->nama }}</td>
            <td>{{ optional($ketua->dosen->prodi)->nama }}</td>
            <td>{{ optional($pengabdian->fokus)->nama }}</td>
            <td>
                @if(!empty($pengabdian->file_proposal))
                    OK
                @endif
            </td>
            <td>
                @if(!empty($pengabdian->file_cv))
                    OK
                @endif
            </td>
            <td>
                @if(!empty($pengabdian->file_pengesahan))
                    OK
                @endif
            </td>
            <td>{{ $pengabdian->status_text }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
