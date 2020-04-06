@extends('layouts.admin')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'List Usulan' => route('reviews.index'),
        'Penilaian' => '#'
    ]) !!}
@endsection

@section('toolbar')
    {!! cui_toolbar_btn(route('reviews.index'), 'cil-list') !!}
@endsection

@section('content')

    {{ html()->form('PUT', route('reviews.update', [$penelitian->id]))->open() }}

    <div class="card">
        <div class="card-header">
            <strong>Penilaian</strong>
        </div>

        <div class="card-body">
            <!-- Static Field for Judul -->
            <div class="form-group">
                <div class='form-label'>Judul</div>
                <div>{!! $penelitian->judul_text !!}</div>
            </div>

            <!-- Static Field for Skim -->
            <div class="form-group">
                <div class='form-label'>Skim</div>
                <div>{{ $penelitian->skema->nama }}</div>
            </div>

            <!-- Static Field for Program Studi -->
            <div class="form-group">
                <div class='form-label'>Program Studi</div>
                <div>{{ optional($penelitian->ketua[0]->dosen->prodi)->nama }}</div>
            </div>

            <!-- Static Field for Fakultas -->
            <div class="form-group">
                <div class='form-label'>Fakultas</div>
                <div>{{ optional($penelitian->ketua[0]->dosen->prodi)->fakultas->nama }}</div>
            </div>

            <!-- Static Field for Ketua Peneliti -->
            <div class="form-group">
                <div class='form-label'>Ketua Peneliti</div>
            </div>
            <!-- Static Field for Ketua -->
            <div class="form-group mr-1">
                <div class='form-label'>Nama</div>
                <div>{{ optional($penelitian->ketua[0])->nama }}</div>
            </div>

            <!-- Static Field for NIDN -->
            <div class="form-group mr-1">
                <div class='form-label'>NIDN</div>
                <div>{{ optional($penelitian->ketua[0])->nidn }}</div>
            </div>

            <!-- Static Field for Jabatan Fungsional -->
            <div class="form-group mr-1">
                <div class='form-label'>Jabatan Fungsional</div>
                <div>{{ $penelitian->ketua[0]->dosen->fungsional_text }}</div>
            </div>

            <!-- Static Field for Anggota Peneliti -->
            <div class="form-group">
                <div class='form-label'>Anggota Peneliti</div>
                <div> {{ $penelitian->anggota_dosens->count() }} orang</div>
            </div>

            <!-- Static Field for Anggota Mahasiswa -->
            <div class="form-group">
                <div class='form-label'>Anggota Mahasiswa</div>
                <div>{{ $penelitian->anggota_mahasiswas->count() }} orang</div>
            </div>

            <!-- Static Field for Biaya Penelitian -->
            <div class="form-group mr-1">
                <div class='form-label'>Biaya Penelitian</div>
            </div>


            <!-- Static Field for Kriteria -->
            <div class="form-group">
                <table class="table table-outline table-responsive-sm">
                    <thead class="{{ config('style.thead') }}">
                    <tr>
                        <th>No</th>
                        <th>Kriteria</th>
                        <th>Bobot (%)</th>
                        <th>Skor</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $no = 1; @endphp
                    @foreach($questions as $question)
                        <tr>
                            <td style="width:5%">{{ $no++ }}</td>
                            <td style="width:50%">{!! $question->pertanyaan_simple !!}</td>
                            <td style="width:10%">{{ $question->bobot }}</td>
                            <td style="width:15%">
                                @php $name = 'pertanyaans['.$question->id.']'; @endphp
                                @if($question->tipe_pertanyaan == 1)
                                    {{ html()->select($name, config('sippmi.opsi_skala_7'), data_get($jawabans, $question->id, null))->class(["form-control", "is-invalid" => $errors->has('pertanyaan')])->id($name) }}
                                @else
                                    {{ html()->text($name)->value(data_get($jawabans, $question->id, null))->class(["form-control", "is-invalid" => $errors->has($name)])->id($name)->placeholder($name) }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Static Field for  -->
            <div class="form-group">
                <div class='form-label'>Biaya Diusulkan</div>
                <div> Rp {{ number_format($penelitian->biaya, 0, ',', '.') }}</div>
            </div>

            <!-- Text Field Input for Direkomendasikan -->
            <div class="form-group">
                <label class="form-label" for="biaya">Rekomendasi Biaya Penelitian</label>
                {{ html()->text('biaya')->value($review->biaya)->class(["form-control", "is-invalid" => $errors->has('biaya')])->id('biaya')->placeholder('Tuliskan biaya tanpa menggunakan titik/koma') }}
                @error('biaya')
                <div class="invalid-feedback">{{ $errors->first('biaya') }}</div>
                @enderror
            </div>


            <!-- Text Field Input for Komentar -->
            <div class="form-group">
                <label class="form-label" for="komentar">Komentar</label>
                {{ html()->textarea('komentar')->value($review->komentar)->class(["form-control", "is-invalid" => $errors->has('komentar')])->id('komentar')->placeholder('Tuliskan komentar Anda terhadap penelitian penelitian ini') }}
                @error('komentar')
                <div class="invalid-feedback">{{ $errors->first('komentar') }}</div>
                @enderror
            </div>

        </div>

        <div class="card-footer">
            <input type="submit" value="Submit" class="btn btn-primary"/>
        </div>

    </div>

    {{ html()->form()->close() }}
@endsection
