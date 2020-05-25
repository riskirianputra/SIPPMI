@extends('layouts.admin')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => url('home'),
        'Pemakalah' => '#'
    ]) !!}
@endsection

@section('toolbar')

@endsection

@section('content')

    <div class="card">
        <div class="card-body">
            <div id="exampleAccordion" data-children=".item">
                <div class="item">
                    <a data-toggle="collapse" data-parent="#exampleAccordion" href="#formPencarian"
                       aria-expanded="false" aria-controls="formPencarian">
                        Pencarian / Export Excel
                    </a>
                    <div class="collapse" id="formPencarian" role="tabpanel">

                    {{ html()->form('POST', route('admin.pemakalahs.filter'))->open() }}
                    <!-- Input (Select) Tahun -->
                        <div class="form-group">
                            <label class="form-label" for="tahun">Tahun</label>
                            {{ html()->select('tahun', $tahuns, $tahun ?? old('tahun'))->class(["form-control", "is-invalid" => $errors->has('tahun')])->id('tahun') }}
                            @error('tahun')
                            <div class="invalid-feedback">{{ $errors->first('tahun') }}</div>
                            @enderror
                        </div>

                        <!-- Input (Select) Skema -->
                        <div class="form-group">
                            <label class="form-label" for="tingkat">Tingkat</label>
                            {{ html()->select('tingkat', $levels, $tingkat ?? old('tingkat'))->class(["form-control", "is-invalid" => $errors->has('tingkat')])->id('tingkat') }}
                            @error('tingkat')
                            <div class="invalid-feedback">{{ $errors->first('tingkat') }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="export">Export Excel?
                                <input name="export" type="checkbox">
                            </label>
                        </div>
                        {{ html()->submit('Filter/Export')->class('btn btn-primary ml-sm-2') }}
                    </div>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <strong>Daftar Pemakalah</strong>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table
                    class=" table table-outline table-striped table-hover datatable datatable-Pemakalah"
                    style="width: 100%"
                >
                    <thead class="thead-light">
                    <tr>
                        <th>
                            Pemakalah
                        </th>
                        <th>
                            Judul Makalah
                        </th>
                        <th>
                            Forum & Penyelenggara
                        </th>
                        <th>
                            Artikel
                        </th>
                        <th class="text-center">
                            <i class="cil-options"></i>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pemakalahs as $key => $pemakalah)
                        <tr data-entry-id="{{ $pemakalah->id }}">
                            <td>
                                {{ $pemakalah->first_author->nama }}<br>
                                <small>{{ $pemakalah->first_author->nidn }}</small>
                                <br>
                                <span class="badge badge-info">
                                    {{ $pemakalah->status_pemakalah_text }}
                                </span>
                            </td>
                            <td>
                                {!! $pemakalah->judulSimple ?? '' !!}
                            </td>
                            <td>
                                <strong>{{ $pemakalah->nama_forum }}</strong>
                                <br>
                                {{ $pemakalah->penyelenggara }}
                                <br>
                                <small>
                                    {{ $pemakalah->tempat }}, {{ $pemakalah->tanggal_mulai }}
                                    s/d {{ $pemakalah->tanggal_selesai }}
                                </small>
                            </td>
                            <td>
                                <a href="{{ $pemakalah->getFileArtikelUrl() }}" target="_blank">
                                    <i class="fa fa-file-pdf-o text-danger"></i>
                                    Proposal
                                </a>
                            </td>
                            <td class="text-center">
                                {!! cui()->btn_view(route('admin.pemakalahs.show', $pemakalah->id)) !!}
                                @if($pemakalah->owner == auth()->user()->id)
                                    {!! cui()->btn_delete(route('admin.pemakalahs.destroy', $pemakalah->id), trans('global.areYouSure')) !!}
                                @endif
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    @parent
    <script>
        $(function () {
            $('.datatable-Pemakalah:not(.ajaxTable)').DataTable()
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })

    </script>
@endsection
