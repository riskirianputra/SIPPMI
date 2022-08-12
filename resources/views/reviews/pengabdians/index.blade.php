@extends('layouts.admin')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Review' => '#'
]) !!}
@endsection

@section('toolbar')

@endsection

@section('content')

    <div class="card">
        <div class="card-header">Filter Pencarian</div>

        {{ html()->form('POST', route('review-pengabdians.filter'))->open() }}

        <div class="card-body">

            <!-- Input (Select) Skema Usulan -->
            <div class="form-group">
                <label class="form-label" for="skema_id">Skema Usulan</label>
                {{ html()->select('skema_id')->options($skemas)->class(["form-control", "is-invalid" => $errors->has('skema_id')])->id('skema_id') }}
                @error('skema_id')
                <div class="invalid-feedback">{{ $errors->first('skema_id') }}</div>
                @enderror
            </div>

            <!-- Input (Select) Tahapan Review -->
            <div class="form-group">
                <label class="form-label" for="tahapan_review_id">Tahapan Review</label>
                {{ html()->select('tahapan_review_id')->options($tahapans)->class(["form-control", "is-invalid" => $errors->has('tahapan_review_id')])->id('tahapan_review_id') }}
                @error('tahapan_review_id')
                <div class="invalid-feedback">{{ $errors->first('tahapan_review_id') }}</div>
                @enderror
            </div>

        </div>

        <div class="card-footer">
            <input type="submit" value="Filter" name="filter" class="btn btn-primary">
        </div>
        {{ html()->form()->close() }}
    </div>


    <div class="card">
        <div class="card-body">
            <table class="table table-outline table-responsive-sm">
                <thead class="thead-light">
                <tr>
                    <th style="width: 20%">Ketua</th>
                    <th style="width: 20%">Anggota</th>
                    <th style="width: 50%">Judul</th>
                    <th>Nilai</th>
                    <th>Review</th>
                </tr>
                </thead>
                <tbody>
                @foreach($usulans as $usulan)
                    <tr>
                        <td class="align-top">
                            {{ $usulan->ketua[0]->nama }}
                            <div class="small">{{ $usulan->ketua[0]->nidn }}</div>
                        </td>
                        <td class="align-top">
                            @foreach($usulan->members as $anggota)
                                <div>
                                    {{ $anggota->nama }}
                                </div>
                                <div class="small text-muted">{{ $anggota->nidn }}</div>
                            @endforeach
                        </td>
                        <td class="align-top">
                            {!! $usulan->judul_simple !!}
                            <br>
                            <span class="text-info">
                                    <small><em>{{ $usulan->skema->nama ?? '' }}</em></small>
                                </span>
                        </td>
                        <td class="text-center align-top">
                            <h4>
                                {{ $usulan->reviewers->where('reviewer_id', $user_id)->first()->sub_total }}
                            </h4>
                        </td>
                        <td class="text-center align-top">
                            {!! cui()->btn_edit(route('review-pengabdians.edit', [$usulan->id])) !!}
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
