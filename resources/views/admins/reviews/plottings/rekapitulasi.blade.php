@extends('layouts.admin')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => url('home'),
        'Rekapitulasi' => '#'
    ]) !!}
@endsection

@section('toolbar')
{{--    @can('penelitian_user_manage')--}}
        {!! cui_toolbar_btn(route('admin.plotting-reviewers.index'), 'icon-plus', 'Plotting Reviewer') !!}
{{--    @endcan--}}
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <strong>Daftar Usulan Penelitian</strong>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-responsive-sm">
                    <thead>
                    <tr>
                        <th class="text-center">
                            Nama Reviewer
                        </th >
                        <th class="text-center">
                            Review Penelitian
                        </th>
                        <th class="text-center">
                            Review Pengabdian
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($reviewers as $key => $reviewer)
                        <tr data-entry-id="{{ $reviewer->id }}">
                            <td>
                                {{ optional($reviewer->dosen)->nama }} <br>
                                <small><em>{{ optional($reviewer->dosen)->nip }}</em></small>
                            </td>
                            <td class="text-center">
                                {!! \App\Penelitian::whereIn('id', $reviewer->penelitianReviewers->pluck('usulan_id'))->count() !!}
                            </td>
                            <td class="text-center">
                                {!! \App\Pengabdian::whereIn('id', $reviewer->penelitianReviewers->pluck('usulan_id'))->count() !!}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                <h5>Belum ada data rekapitulasi</h5>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

@endsection
