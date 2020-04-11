@extends('layouts.admin')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'List Usulan' => route('review-penelitians.index'),
        'Penilaian' => '#'
    ]) !!}
@endsection

@section('toolbar')
    {!! cui_toolbar_btn(route('review-penelitians.index'), 'cil-list') !!}
@endsection

@section('content')

    {{ html()->form('PATCH', route('review-penelitians.update', [$penelitian->id]))->open() }}


    <div class="card">
        <div class="card-header">
            <strong>Penilaian</strong>
        </div>

        <div class="card-body">
            <!-- Static Field for Judul -->
            <div class="form-group row">
                <div class='col-md-3 col-form-label'>Judul</div>
                <div class="col-md-9">
                    <div>{!! $penelitian->judul_text !!}</div>
                </div>
            </div>

            <!-- Static Field for Skim -->
            <div class='form-group row'>
                <div class='col-md-3 col-form-label'>Skim</div>
                <div class="col-md-9">
                    <div>{{ $penelitian->skema->nama }}</div>
                </div>
            </div>

            <!-- Static Field for Program Studi -->
            <div class='form-group row'>
                <div class='col-md-3 col-form-label'>Prodi/Fakultas</div>
                <div class="col-md-9">
                    <div>
                        {{ optional($penelitian->ketua[0]->dosen->prodi)->nama }} /
                        {{ optional($penelitian->ketua[0]->dosen->prodi)->fakultas->nama }}
                    </div>
                </div>
            </div>

            <!-- Static Field for Ketua Peneliti -->
            <div class='form-group row'>
                <div class='col-md-3 col-form-label'>Ketua Peneliti</div>
                <div class="col-md-9">
                    <div>{{ optional($penelitian->ketua[0])->nama }}</div>
                    <div>{{ optional($penelitian->ketua[0])->nidn }}</div>
                    <div>{{ $penelitian->ketua[0]->dosen->fungsional_text }}</div>
                </div>
            </div>


            <!-- Static Field for Anggota Peneliti -->
            <div class='form-group row'>
                <div class='col-md-3 col-form-label'>Anggota (Dosen)</div>
                <div class="col-md-9">
                    <ul>
                        @foreach($penelitian->anggota_dosens as $dosen)
                            <li>{{ optional($dosen)->nama }} / <small> {{ optional($dosen)->nidn }}</small></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class='form-group row'>
                <div class='col-md-3 col-form-label'>Anggota (Mahasiswa)</div>
                <div class="col-md-9">
                    <ul>
                        @foreach($penelitian->anggota_mahasiswas as $mahasiswa)
                            <li>{{ optional($mahasiswa)->nama }} / <small> {{ optional($mahasiswa)->nidn }}</small></li>
                        @endforeach
                    </ul>
                </div>
            </div>


            <div class="form-group row">
                <div class="col-sm-3">
                    <strong>File</strong>
                </div>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-3">
                            <a href="{{ $penelitian->getFileProposalUrl() }}" target="_blank">
                                <i class="fa fa-file-pdf-o text-danger"></i>
                                Proposal
                            </a>
                        </div>
                        <div class="col-sm-3">
                            <a href="{{ $penelitian->getFileCvUrl() }}" target="_blank">
                                <i class="fa fa-file-pdf-o text-danger"></i>
                                CV
                            </a>
                        </div>
                        <div class="col-sm-3">
                            <a href="{{ $penelitian->getFilePengesahanUrl() }}" target="_blank">
                                <i class="fa fa-file-pdf-o text-danger"></i>
                                Lembaran Pengesahan
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Static Field for Kriteria -->
            <div class='form-group row'>
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
            <div class='form-group row'>
                <div class='col-md-3 col-form-label'>Biaya Diusulkan</div>
                <div class="col-md-9">
                    <div> Rp {{ number_format($penelitian->biaya, 0, ',', '.') }}</div>
                </div>
            </div>

            <!-- Text Field Input for Direkomendasikan -->
            <div class='form-group row'>
                <label class="col-md-3 col-form-label" for="biaya">Rekomendasi Biaya Penelitian</label>
                <div class="col-md-5">
                    {{ html()->text('biaya')->value($review->biaya)->class(["form-control", "is-invalid" => $errors->has('biaya')])->id('biaya')->placeholder('Tuliskan biaya tanpa menggunakan titik/koma') }}
                    @error('biaya')
                    <div class="invalid-feedback">{{ $errors->first('biaya') }}</div>
                    @enderror
                </div>
            </div>


            <!-- Text Field Input for Komentar -->
            <div class='form-group row'>
                <label class="col-md-3 col-form-label" for="komentar">Komentar</label>
                <div class="col-md-9">
                    {{ html()->textarea('komentar')->value($review->komentar)->class(["form-control", "is-invalid" => $errors->has('komentar')])->id('komentar')->placeholder('Tuliskan komentar Anda terhadap penelitian penelitian ini') }}
                    @error('komentar')
                    <div class="invalid-feedback">{{ $errors->first('komentar') }}</div>
                    @enderror
                </div>
            </div>

        </div>

        <div class="card-footer">
            <input type="submit" value="Submit" class="btn btn-primary"/>
        </div>

    </div>

    {{ html()->form()->close() }}
@endsection

@section('styles')
    <style>
        .col-form-label {
            font-weight: bold;
        }
    </style>
@endsection
