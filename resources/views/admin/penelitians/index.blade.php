@extends('layouts.admin')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => url('home'),
        'Penelitian' => '#'
    ]) !!}
@endsection

@section('toolbar')

@endsection

@section('content')

    <div class="card">
        <div class="card-body">
            {{ html()->form('POST', route('admin.penelitians.filter'))->class('form-inline')->open() }}
            {{ html()->label('Tahun', 'tahun')->class('my-1 mr-sm-2') }}
            {{ html()->select('tahun', $tahun_penelitians,old('tahun'))->class('form-control') }}
            {{ html()->label('Skema', 'skema')->class('my-1 mr-sm-2 ml-sm-2') }}
            {{ html()->select('skema', $skema_penelitians, old('skema'))->class('form-control') }}
            {{ html()->submit('Filter')->class('btn btn-primary ml-sm-2') }}
            {{ html()->form()->close() }}
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <strong>Daftar Usulan Penelitian</strong>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover datatable datatable-Penelitian">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            Peneliti
                        </th>
                        <th class="text-center">
                            {{ trans('cruds.penelitian.fields.judul') }}
                            ( {{ trans('cruds.penelitian.fields.skema') }} )
                        </th>
                        <th class="text-center">
                            {{ trans('cruds.penelitian.fields.biaya') }}
                        </th>
                        <th class="text-center">
                            Proposal
                        </th>
                        <th class="text-center">
                            CV
                        </th>
                        <th class="text-center">
                            Lembaran<br>Pengesahan
                        </th>
                        <th class="text-center">
                            Status<br>Penelitian
                        </th>
                        <th class="text-center">
                            &nbsp;Aksi
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($penelitians as $key => $penelitian)
                        <tr data-entry-id="{{ $penelitian->id }}" @if($penelitian->hasKomentar())class="bg-warning" @endif>
                            <td>

                            </td>
                            <td>

                                @foreach($penelitian->anggotas as $anggota)
                                    @if($anggota->jabatan == 1)
                                        <strong>{{ $anggota->nama }} <small>({{ $anggota->nidn }})</small></strong> <br>
                                        <br>
                                    @else
                                        {{ $anggota->nama }} <small>({{ $anggota->nidn }})</small><br>
                                    @endif
                                @endforeach

                            </td>
                            <td>
                                {!! $penelitian->judulSimple ?? '' !!}
                                <br>
                                <span class="text-info">
                                    <small><em>{{ $penelitian->skema->nama ?? '' }}</em></small>
                                </span>
                                <br>
                                @if($penelitian->hasKomentar())
                                    <i class="cil-warning text-warning"></i>
                                @endif
                            </td>
                            <td class="text-right">
                                {{ number_format($penelitian->biaya,0, ',', '.').',-' ?? '' }}
                            </td>
                            <td class="text-center">
                                @if(!empty($penelitian->file_proposal))
                                    <a href="{{ $penelitian->getFileProposalPath() }}" target="_blank">
                                        <i class="fa fa-file-pdf-o text-danger"></i>
                                    </a>
                                @endif
                            </td>
                            <td class="text-center">
                                @if(!empty($penelitian->file_cv))
                                    <a href="{{ $penelitian->getFileCvPath() }}" target="_blank">
                                        <i class="fa fa-file-pdf-o text-danger"></i>
                                    </a>
                                @endif

                            </td>
                            <td class="text-center">
                                @if(!empty($penelitian->file_pengesahan))
                                    <a href="{{ $penelitian->getFilePengesahanPath() }}" target="_blank">
                                        <i class="fa fa-file-pdf-o text-danger"></i>
                                    </a>
                                @endif

                            </td>
                            <td class="text-center">
                                <h5>
                                    <span class="badge badge-{!! $penelitian->statusTextColor !!}">
                                       {{ $penelitian->statusText }}
                                    </span>
                                </h5>

                            </td>
                            <td class="text-center">
                                {!! cui()->btn_view(route('admin.penelitians.show', $penelitian->id)) !!}
                                @if($penelitian->owner == auth()->user()->id)
                                    {!! cui()->btn_edit(route('admin.penelitians.edit', $penelitian->id)) !!}
                                    {!! cui()->btn_delete(route('admin.penelitians.destroy', $penelitian->id), trans('global.areYouSure')) !!}
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
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
                @can('penelitian_manage')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.penelitians.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({selected: true}).nodes(), function (entry) {
                        return $(entry).data('entry-id')
                    });

                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}')

                        return
                    }

                    if (confirm('{{ trans('global.areYouSure') }}')) {
                        $.ajax({
                            headers: {'x-csrf-token': _token},
                            method: 'POST',
                            url: config.url,
                            data: {ids: ids, _method: 'DELETE'}
                        })
                            .done(function () {
                                location.reload()
                            })
                    }
                }
            }
            dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                order: [[1, 'desc']],
                pageLength: 100,
            });
            $('.datatable-Penelitian:not(.ajaxTable)').DataTable({buttons: dtButtons})
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })

    </script>
@endsection
