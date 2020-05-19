<table class="table">
    <thead>
    <tr>
        <th scope="col" class="text-center">Nama <br> NIP</th>
        <th scope="col" class="text-center">Prodi</th>
        <th scope="col" class="text-center">Jabatan</th>
        <th scope="col" class="text-center">Hapus</th>
    </tr>
    </thead>
    <tbody>
    @foreach($penelitian->anggotas as $anggota)
        <tr>
            <td>
                {{ optional($anggota->dosen)->nama }} <br>
                <small>{{ optional($anggota->dosen)->nip }}</small><br>
                <small>{{ optional($anggota->dosen)->nidn }}</small>
            </td>
            <td>
                {{ optional($anggota->dosen->prodi)->nama }}
            </td>
            <td class="text-center">
                @if(isset($anggota->jabatan))
                    {{ \App\PenelitianAnggotum::JABATAN_SELECT[$anggota->jabatan] }}
                @endif
            </td>
            <td class="text-center">
                @if($penelitian->owner != $anggota->dosen_id)
                    {!! cui()->btn_delete(route('penelitian.anggota.destroy', [$penelitian->id, $anggota->id]), trans('global.areYouSure')) !!}
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
