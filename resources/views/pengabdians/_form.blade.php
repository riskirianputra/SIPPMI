<div class="form-group">
    <label class="required" for="judul">{{ trans('cruds.pengabdian.fields.judul') }}</label>
    {{ html()->hidden('judul')->id('judul')->class('form-control '. $errors->has('judul') ? 'is-invalid' : '' )->required() }}

    <div id="editor">
        {!! old('judul', optional($pengabdian ?? '')->judul) !!}
    </div>
    @if($errors->has('judul'))
        <div class="invalid-feedback">
            {{ $errors->first('judul') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.pengabdian.fields.judul_helper') }}</span>
</div>

<div class="form-group">
    <label for="skema_id">{{ trans('cruds.pengabdian.fields.skema') }}</label>
    {{ html()->select('skema_id', $skemas)->id('skema_id')->class(['form-control', 'select2', 'is-invalid' => $errors->has('skema')]) }}

    @if($errors->has('skema_id'))
        <div class="invalid-feedback">
            {{ $errors->first('skema_id') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.pengabdian.fields.skema_helper') }}</span>
</div>

<div class="form-group">
    <label for="kode_rumpun_id">{{ trans('cruds.pengabdian.fields.kode_rumpun') }}</label>
    {{ html()->select('kode_rumpun_id', $kode_rumpuns)->id('kode_rumpun_id')->class(['form-control', 'select2', 'is-invalid' => $errors->has('kode_rumpun')]) }}
    @if($errors->has('kode_rumpun_id'))
        <div class="invalid-feedback">
            {{ $errors->first('kode_rumpun_id') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.pengabdian.fields.kode_rumpun_helper') }}</span>
</div>

<div class="form-group">
    <label class="required" for="prodi_id">{{ trans('cruds.pengabdian.fields.prodi') }}</label>
    {{ html()->select('prodi_id', $prodis)->id('prodi_id')->class(['form-control', 'select2', 'is-invalid' => $errors->has('prodi')]) }}
    @if($errors->has('prodi_id'))
        <div class="invalid-feedback">
            {{ $errors->first('prodi_id') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.pengabdian.fields.prodi_helper') }}</span>
</div>

<div class="form-group">
    <label for="mitra_pengabdian">{{ trans('cruds.pengabdian.fields.mitra_pengabdian') }}</label>
    {{ html()->text('mitra_pengabdian')->id('mitra_pengabdian')->class(['form-control', 'is-invalid' => $errors->has('mitra_pengabdian') ]) }}
    @if($errors->has('mitra_pengabdian'))
        <div class="invalid-feedback">
            {{ $errors->first('mitra_pengabdian') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.pengabdian.fields.mitra_pengabdian_helper') }}</span>
</div>

<div class="form-group">
    <label>{{ trans('cruds.pengabdian.fields.multi_tahun') }}</label>
    {{ html()->select('multi_tahun', App\Pengabdian::MULTI_TAHUN_SELECT)->id('multi_tahun')->class(['form-control', 'select2', 'is-invalid' => $errors->has('multi_tahun')])  }}
    @if($errors->has('multi_tahun'))
        <div class="invalid-feedback">
            {{ $errors->first('multi_tahun') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.pengabdian.fields.multi_tahun_helper') }}</span>
</div>

<div class="form-group">
    <label for="biaya">{{ trans('cruds.pengabdian.fields.biaya') }}</label>
    {{ html()->text('biaya')->id('biaya')->class(['form-control', 'is-invalid' => $errors->has('biaya') ]) }}
    @if($errors->has('biaya'))
        <div class="invalid-feedback">
            {{ $errors->first('biaya') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.pengabdian.fields.biaya_helper') }}</span>
</div>

<div class="form-group">
    <label for="file_pengesahan">Lembaran Pengesahan</label>
    {{ html()->input('file', 'file_pengesahan')->id('file_pengesahan')->class('form-control') }}
    @if($errors->has('file_pengesahan'))
        <div class="invalid-feedback">
            {{ $errors->first('file_pengesahan') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.pengabdian.fields.file_proposal_helper') }}</span>
    @if(isset($pengabdian) && !empty($pengabdian->file_pengesahan))
        <a href="{{ $pengabdian->getFilePengesahanUrl() ?? '' }}" target="_blank">
            <i class="fa fa-file-pdf text-danger"></i>
            Download
        </a>
    @endif
</div>

<div class="form-group">
    <label for="file_proposal">File Proposal</label>
    {{ html()->input('file', 'file_proposal')->id('file_proposal')->class('form-control') }}
    @if($errors->has('file_proposal'))
        <div class="invalid-feedback">
            {{ $errors->first('file_proposal') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.pengabdian.fields.file_proposal_helper') }}</span>
    @if(isset($pengabdian) && !empty($pengabdian->file_proposal))
        <a href="{{ $pengabdian->getFileProposalUrl() ?? '' }}" target="_blank">
            <i class="fa fa-file-pdf text-danger"></i>
            Download
        </a>
    @endif
</div>

<div class="form-group">
    <label for="file_cv">File CV</label>
    {{ html()->input('file', 'file_cv')->id('file_cv')->class('form-control') }}
    @if($errors->has('file_proposal'))
        <div class="invalid-feedback">
            {{ $errors->first('file_cv') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.pengabdian.fields.file_proposal_helper') }}</span>
    @if(isset($pengabdian) && !empty($pengabdian->file_cv))
        <a href="{{ $pengabdian->getFileCvUrl() ?? ''->getFileCvUrl() }}" target="_blank">
            <i class="fa fa-file-pdf text-danger"></i>
            Download
        </a>
    @endif
</div>
