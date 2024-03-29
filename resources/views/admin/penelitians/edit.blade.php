@extends('layouts.admin')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => url('home'),
        'Penelitian' => route('admin.penelitians.index'),
        'Edit' => '#'
    ]) !!}
@endsection

@section('toolbar')
    {!! cui_toolbar_btn(route('admin.penelitians.index'), 'icon-list', 'List Penelitian') !!}
@endsection

@section('content')

    <div class="card">

        {{ html()->modelForm($penelitian, 'PUT', route('admin.penelitians.update', [$penelitian->id]))->acceptsFiles()->open() }}

        <div class="card-header">
            Edit Usulan Penelitian
        </div>

        <div class="card-body">

            <div class="form-group">
                <label class="required" for="judul">{{ trans('cruds.penelitian.fields.judul') }}</label>
                {{ html()->hidden('judul')->id('judul')->class('form-control '. $errors->has('judul') ? 'is-invalid' : '' )->required() }}

                <div id="editor">
                    {!! old('judul', optional($penelitian ?? '')->judul) !!}
                </div>
                @if($errors->has('judul'))
                    <div class="invalid-feedback">
                        {{ $errors->first('judul') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.penelitian.fields.judul_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="skema_id">{{ trans('cruds.penelitian.fields.skema') }}</label>
                {{ html()->select('skema_id', $skemas)->id('skema_id')->class(['form-control', 'select2', 'is-invalid' => $errors->has('skema')])->placeholder('Pilihan Skema Penelitian') }}

                @if($errors->has('skema_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('skema_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.penelitian.fields.skema_helper') }}</span>
            </div>

            {{--<div class="form-group">--}}
            {{--    <label for="kode_rumpun_id">{{ trans('cruds.penelitian.fields.kode_rumpun') }}</label>--}}
            {{--    {{ html()->select('kode_rumpun_id', $kode_rumpuns)->id('kode_rumpun_id')->class(['form-control', 'select2', 'is-invalid' => $errors->has('kode_rumpun')]) }}--}}
            {{--    @if($errors->has('kode_rumpun_id'))--}}
            {{--        <div class="invalid-feedback">--}}
            {{--            {{ $errors->first('kode_rumpun_id') }}--}}
            {{--        </div>--}}
            {{--    @endif--}}
            {{--    <span class="help-block">{{ trans('cruds.penelitian.fields.kode_rumpun_helper') }}</span>--}}
            {{--</div>--}}

            {{--<div class="form-group">--}}
            {{--    <label class="required" for="prodi_id">{{ trans('cruds.penelitian.fields.prodi') }}</label>--}}
            {{--    {{ html()->select('prodi_id', $prodis)->id('prodi_id')->class(['form-control', 'select2', 'is-invalid' => $errors->has('prodi')]) }}--}}
            {{--    @if($errors->has('prodi_id'))--}}
            {{--        <div class="invalid-feedback">--}}
            {{--            {{ $errors->first('prodi_id') }}--}}
            {{--        </div>--}}
            {{--    @endif--}}
            {{--    <span class="help-block">{{ trans('cruds.penelitian.fields.prodi_helper') }}</span>--}}
            {{--</div>--}}

            <div class="form-group">
                <label class="required" for="fokus_id">{{ trans('cruds.penelitian.fields.fokus') }}</label>
                {{ html()->select('fokus_id', $prnFokus)->id('fokus_id')->class(['form-control', 'is-invalid' => $errors->has('fokus_id')]) }}
                @if($errors->has('fokus_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fokus_id') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label>{{ trans('cruds.penelitian.fields.multi_tahun') }}</label>
                {{ html()->select('multi_tahun', App\Penelitian::MULTI_TAHUN_SELECT)->id('multi_tahun')->class(['form-control', 'select2', 'is-invalid' => $errors->has('multi_tahun')])  }}
                @if($errors->has('multi_tahun'))
                    <div class="invalid-feedback">
                        {{ $errors->first('multi_tahun') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.penelitian.fields.multi_tahun_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="biaya">{{ trans('cruds.penelitian.fields.biaya') }}</label>
                {{ html()->text('biaya')->id('biaya')->class(['form-control', 'is-invalid' => $errors->has('biaya') ]) }}
                @if($errors->has('biaya'))
                    <div class="invalid-feedback">
                        {{ $errors->first('biaya') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.penelitian.fields.biaya_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="file_pengesahan">Lembaran Pengesahan</label>
                {{ html()->input('file', 'file_pengesahan')->id('file_pengesahan')->class('form-control')->attribute('aria-describedBy', 'file_pengesahan_help') }}
                <small id="file_pengesahan_help" class="form-text text-muted">Maksimal ukuran file : 5 MB</small>
                @if($errors->has('file_pengesahan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file_pengesahan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.penelitian.fields.file_proposal_helper') }}</span>
                @if(isset($penelitian) && !empty($penelitian->file_pengesahan))
                    <a href="{{ $penelitian->getFilePengesahanUrl() ?? '' }}" target="_blank">
                        <i class="fa fa-file-pdf text-danger"></i>
                        Download
                    </a>
                @endif
            </div>

            <div class="form-group">
                <label for="file_proposal">File Proposal</label>
                {{ html()->input('file', 'file_proposal')->id('file_proposal')->class('form-control')->attribute('aria-describedBy', 'file_proposal_help') }}
                <small id="file_proposal_help" class="form-text text-muted">Maksimal ukuran file : 10 MB</small>
                @if($errors->has('file_proposal'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file_proposal') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.penelitian.fields.file_proposal_helper') }}</span>
                @if(isset($penelitian) && !empty($penelitian->file_proposal))
                    <a href="{{ $penelitian->getFileProposalUrl() ?? '' }}" target="_blank">
                        <i class="fa fa-file-pdf text-danger"></i>
                        Download
                    </a>
                @endif
            </div>

            <div class="form-group">
                <label for="file_cv">File CV</label>
                {{ html()->input('file', 'file_cv')->id('file_cv')->class('form-control')->attribute('aria-describedBy', 'file_cv_help') }}
                <small id="file_cv_help" class="form-text text-muted">Maksimal ukuran file : 5 MB</small>
                @if($errors->has('file_proposal'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file_cv') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.penelitian.fields.file_proposal_helper') }}</span>
                @if(isset($penelitian) && !empty($penelitian->file_cv))
                    <a href="{{ $penelitian->getFileCvUrl() ?? ''->getFileCvUrl() }}" target="_blank">
                        <i class="fa fa-file-pdf text-danger"></i>
                        Download
                    </a>
                @endif
            </div>

        </div>

        <div class="card-footer">
            <button class="btn btn-primary" type="submit">
                Simpan
            </button>
        </div>

        {{ html()->closeModelForm() }}

    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            var quill = new Quill('#editor', {
                theme: 'snow',   // Specify theme in configuration
                modules: {
                    toolbar: ['bold', 'italic', 'underline']
                }
            });

            var editor = document.getElementById('editor').getElementsByClassName('ql-editor')[0];
            var inputJudul = document.getElementById("judul");
            var text = "";

            quill.on('text-change', function () {
                text = editor.innerHTML;
                console.log(text);
                inputJudul.value = text;
            })
        });
    </script>
@endsection
