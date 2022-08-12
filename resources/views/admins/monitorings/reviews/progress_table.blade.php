<table class="table table-outline">
    <thead class="thead-light">
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
        @for($i = 1 ; $i <= $jumlah_reviewers; $i++)
            <th>Nama<br>Reviewer #{{ $i }}</th>
            <th>Komentar<br>Reviewer #{{ $i }}</th>
            <th>Nilai<br>Reviewer #{{ $i }}</th>
            <th>Biaya<br>Reviwer ${{ $i }}</th>
        @endfor
    </tr>
    </thead>
    <tbody>
    @foreach($usulans as $usulan)
        @php
            $ketua = $usulan->ketua[0];
        @endphp
        <tr>
            <td class="align-top">{{ $no++ }}</td>
            <td class="align-top">{{ optional($ketua)->nidn }}</td>
            <td class="align-top">{{ optional($ketua)->nama }}</td>
            <td class="align-top">
                @if($usulan->anggota_dosens)
                    @foreach($usulan->anggota_dosens as $anggota)
                        {{ $anggota->nama }} / {{ $anggota->nidn }}<br>
                    @endforeach
                @endif
            </td>
            <td class="align-top">
                @if($usulan->anggota_mahasiswas)
                    @foreach($usulan->anggota_mahasiswas as $anggota)
                        {{ $anggota->nama }} / {{ $anggota->nidn }}<br>
                    @endforeach
                @endif
            </td>
            <td class="align-top">{{ $usulan->judul_text }}</td>
            <td class="align-top">{{ optional($usulan->skema)->nama }}</td>
            <td class="align-top">{{ $usulan->biaya }}</td>
            <td class="align-top">{{ optional($ketua->dosen->prodi)->fakultas->nama }}</td>
            <td class="align-top">{{ optional($ketua->dosen->prodi)->nama }}</td>
            <td class="align-top">{{ optional($usulan->fokus)->nama }}</td>
            @foreach($usulan->reviewers as $reviewer)
                <td class="align-top">{{ $reviewer->dosen->nama }}</td>
                <td class="align-top">{{ $reviewer->komentar }}</td>
                <td class="align-top">{{ $reviewer->sub_total }}</td>
                <td class="align-top">{{ $reviewer->biaya }}</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
