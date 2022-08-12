@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Dosen' => route('admin.dosens.index'),
        'Skema Penelitian' => '#'
    ]) !!}
@stop

@section('toolbar')
@stop

@section('content')


            <form method="POST" action="{{ route('admin.dosens.skemas.store', [$dosen->id]) }}">
                @csrf

            <div class="card">
                <div class="card-header">
                    <strong>Atur Skema Penelitian Dosen</strong>
                </div>

                <div class="card-body">

                    <!-- Static Field for  -->
                    <div class="form-group">
                        <div><strong>Nama</strong></div>
                        <div>{{ $dosen->nama }}</div>
                    </div>

                    <!-- Static Field for NIP -->
                    <div class="form-group">
                        <div><strong>NIP</strong></div>
                        <div>{{ $dosen->nip ?? "-" }}</div>
                    </div>

                    <!-- Static Field for NIDN -->
                    <div class="form-group">
                        <div><strong>NIDN</strong></div>
                        <div>{{ $dosen->nidn ?? "-" }}</div>
                    </div>

                    <!-- Static Field for Skema Penelitian -->
                    <div class="form-group">
                        <label class="col-form-label" for="skemas"><strong>Skema Penelitian</strong></label>

                        @foreach($skema_penelitians as $skema)
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox"
                                       class="custom-control-input"
                                       @if(array_key_exists($skema->id, $dosen_skemas)) checked @endif
                                       id="skema_{{$skema->id}}"
                                       name="skemas[{{$skema->id}}]"
                                       value="{{ $skema->id }}" />
                                <label class="custom-control-label"
                                       for="skema_{{$skema->id}}">{{ $skema->nama }}</label>
                            </div>
                        @endforeach
                    </div>

                    <!-- Static Field for Skema Penelitian -->
                    <div class="form-group">
                        <label class="col-form-label" for="skemas"><strong>Skema Pengabdian</strong></label>

                        @foreach($skema_pengabdians as $skema)
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox"
                                       class="custom-control-input"
                                       @if(array_key_exists($skema->id, $dosen_skemas)) checked @endif
                                       id="skema_{{$skema->id}}"
                                       name="skemas[{{$skema->id}}]"
                                       value="{{ $skema->id }}" />
                                <label class="custom-control-label"
                                       for="skema_{{$skema->id}}">{{ $skema->nama }}</label>
                            </div>
                        @endforeach
                    </div>

                </div>

                <div class="card-footer">
                    <input type="submit" class="btn btn-primary" value="Simpan">
                </div>
            </div>

            </form>

@endsection
