<div class="text-black-50">

    @if(isset($penelitian))
        @forelse($penelitian->usulan->komentars as $komentar)
            <div class="row">
                <div class="col-sm-12">
                    <em>{{ $komentar->created_at->toDateString() }}</em>
                    {!! $komentar->statusIcon !!}
                    <br>
                    {{ $komentar->komentar }}
                    <div class="text-right">
                        @can('usulan_komentar_manage')

                            @if($komentar->status  == \App\UsulanKomentar::OPEN)
                                {!! cui()->btn(route('admin.usulan.komentars.close', [$penelitian, $komentar]),' cil-check-circle') !!}
                            @else
                                {!! cui()->btn(route('admin.usulan.komentars.open', [$penelitian, $komentar]),' cil-ban') !!}
                            @endif

                            {!! cui()->btn_edit(route('admin.usulan.komentars.edit', [$penelitian->id, $komentar->id])) !!}
                            {!! cui()->btn_delete(route('admin.usulan.komentars.destroy', [$penelitian->id, $komentar->id]), 'Anda yakin menghapus komentar ini') !!}
                        @endcan
                    </div>
                </div>
            </div>
        @empty
            <h5>Tidak ada komentar</h5>
        @endforelse
    @elseif(isset($pengabdian))
        @forelse($pengabdian->usulan->komentars as $komentar)
            <div class="row">
                <div class="col-sm-12">
                    <em>{{ $komentar->created_at->toDateString() }}</em>
                    {!! $komentar->statusIcon !!}
                    <br>
                    {{ $komentar->komentar }}
                    <div class="text-right">
                        @can('usulan_komentar_manage')

                            @if($komentar->status  == \App\UsulanKomentar::OPEN)
                                {!! cui()->btn(route('admin.usulan.komentars.close', [$pengabdian, $komentar]),' cil-check-circle') !!}
                            @else
                                {!! cui()->btn(route('admin.usulan.komentars.open', [$pengabdian, $komentar]),' cil-ban') !!}
                            @endif

                            {!! cui()->btn_edit(route('admin.usulan.komentars.edit', [$pengabdian->id, $komentar->id])) !!}
                            {!! cui()->btn_delete(route('admin.usulan.komentars.destroy', [$pengabdian->id, $komentar->id]), 'Anda yakin menghapus komentar ini') !!}
                        @endcan
                    </div>
                </div>
            </div>
        @empty
            <h5>Tidak ada komentar</h5>
        @endforelse
    @endif

</div>
