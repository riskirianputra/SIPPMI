<table class="table table-outline">
    <thead>
    <tr>
        <th>No</th>
        <th>NIDN</th>
        <th>Nama</th>
        <th>Fakultas</th>
        <th>Prodi</th>
        <th>Tahun Usulan</th>
        <th>Jumlah Usulan <br>(Ketua)</th>
        <th>Jumlah Usulan <br>(Anggota)</th>
        <th>Total Usulan</th>
    </tr>
    </thead>
    <tbody>
    @foreach($dosens as $dosen)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $dosen->nidn }}</td>
            <td>{{ $dosen->nama }}</td>
            <td>{{ $dosen->fakultas }}</td>
            <td>{{ $dosen->prodi }}</td>
            <td>{{ $dosen->tahun }}</td>
            <td>{{ $dosen->usulan_ketua }}</td>
            <td>{{ $dosen->usulan_anggota }}</td>
            <td>{{ $dosen->usulan_total }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
