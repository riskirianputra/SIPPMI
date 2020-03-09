<table class="table table-hover table-sm">
    <thead>
    <tr>
        <th scope="col" >
            Nama / NIP
        </th>
        <th >
            NIDN
        </th>
        <th scope="col" >Prodi</th>
        <th scope="col" >Jabatan</th>
    </tr>
    </thead>
    <tbody>
    @foreach($penelitian->usulan->anggotas->filter(function ($value,$key){return $value->tipe == 1;}) as $anggota)
        <tr>
            <td>
                {{ optional($anggota->dosen)->nama }} <br>
                <small><em>{{ optional($anggota->dosen)->nip }}</em></small>
            </td>
            <td>
                {{ optional($anggota->dosen)->nidn }}
            </td>
            <td>
                {{ optional($anggota->dosen->prodi)->nama }}
            </td>
            <td >
                @if(isset($anggota->jabatan))
                    {{ \App\PenelitianAnggotum::JABATAN_SELECT[$anggota->jabatan] }}
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
