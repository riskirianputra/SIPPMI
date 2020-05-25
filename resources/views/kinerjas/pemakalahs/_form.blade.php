<div class="form-group">
    <label class="required form-label" for="judul">Judul Makalah/Artikel</label>
    {{ html()->hidden('judul')->id('judul')->class('form-control '. $errors->has('judul') ? 'is-invalid' : '' )->required() }}

    <div id="editor">
        {!! old('judul', optional($makalah ?? '')->judul) !!}
    </div>
    @if($errors->has('judul'))
        <div class="invalid-feedback">
            {{ $errors->first('judul') }}
        </div>
    @endif
</div>

<!-- Text Field Input for Tahun Seminar -->
<div class="form-group">
    <label class="form-label" for="tahun">Tahun Seminar</label>
    {{ html()->select('tahun', $tahuns)->class(["form-control", "is-invalid" => $errors->has('tahun')])->id('tahun')->placeholder("-- Pilih Tahun --") }}
    @error('tahun')
    <div class="invalid-feedback">{{ $errors->first('tahun') }}</div>
    @enderror
</div>

<!-- Text Field Input for Nama Forum/Seminar -->
<div class="form-group">
    <label class="form-label" for="nama_forum">Nama Forum/Seminar</label>
    {{ html()->text('nama_forum')->class(["form-control", "is-invalid" => $errors->has('nama_forum')])->id('nama_forum')->placeholder('Nama Forum/Seminar Ilmiah') }}
    @error('nama_forum')
    <div class="invalid-feedback">{{ $errors->first('nama_forum') }}</div>
    @enderror
</div>

<!-- Input (Select) Level Forum -->
<div class="form-group">
    <label class="form-label" for="tingkat">Level Forum</label>
    {{ html()->select('tingkat')->options($levels)->class(["form-control", "is-invalid" => $errors->has('tingkat')])->id('tingkat')->placeholder('-- Pilih tingkat Forum --') }}
    @error('tingkat')
    <div class="invalid-feedback">{{ $errors->first('tingkat') }}</div>
    @enderror
</div>

<!-- Input (Select) Status Pemakalah -->
<div class="form-group">
    <label class="form-label" for="status_pemakalah">Status Pemakalah</label>
    {{ html()->select('status_pemakalah')->options($statuses)->class(["form-control", "is-invalid" => $errors->has('status_pemakalah')])->id('status_pemakalah')->placeholder('-- Pilih Status Pemakalah --') }}
    @error('status_pemakalah')
    <div class="invalid-feedback">{{ $errors->first('status_pemakalah') }}</div>
    @enderror
</div>

<!-- Text Field Input for Penyelenggara -->
<div class="form-group">
    <label class="form-label" for="penyelenggara">Penyelenggara</label>
    {{ html()->text('penyelenggara')->class(["form-control", "is-invalid" => $errors->has('penyelenggara')])->id('penyelenggara')->placeholder('Institusi Penyelenggara Forum/Seminar Ilmiah') }}
    @error('penyelenggara')
    <div class="invalid-feedback">{{ $errors->first('penyelenggara') }}</div>
    @enderror
</div>

<!-- Text Field Input for Tempat -->
<div class="form-group">
    <label class="form-label" for="tempat">Tempat</label>
    {{ html()->text('tempat')->class(["form-control", "is-invalid" => $errors->has('tempat')])->id('tempat')->placeholder('Tempat penyelenggaraan seminar') }}
    @error('tempat')
    <div class="invalid-feedback">{{ $errors->first('tempat') }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-sm">
        <!-- Text Field Input for Mulai Tanggal  -->
        <div class="form-group">
            <label class="form-label" for="tanggal_mulai">Mulai Tanggal</label>
            {{ html()->date('tanggal_mulai')->class(["form-control", "is-invalid" => $errors->has('tanggal_mulai')])->id('tanggal_mulai') }}
            @error('tanggal_mulai')
            <div class="invalid-feedback">{{ $errors->first('tanggal_mulai') }}</div>
            @enderror
        </div>
    </div>
    <div class="col-sm">
        <!-- Text Field Input for Selesai  -->
        <div class="form-group">
            <label class="form-label" for="tanggal_mulai">Selesai Tanggal</label>
            {{ html()->date('tanggal_selesai')->class(["form-control", "is-invalid" => $errors->has('tanggal_selesai')])->id('tanggal_selesai') }}
            @error('tanggal_selesai')
            <div class="invalid-feedback">{{ $errors->first('tanggal_selesai') }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="form-group">
    <label class="form-label" for="file_artikel">Makalah</label>
    {{ html()->input('file', 'file_artikel')->id('file_artikel')->class('form-control')->attribute('aria-describedBy', 'file_artikel_help') }}
    <small id="file_artikel_help" class="form-text text-muted">Maksimal ukuran file : 5 MB</small>
    @if($errors->has('file_artikel'))
        <div class="invalid-feedback">
            {{ $errors->first('file_artikel') }}
        </div>
    @endif
    @if(isset($makalah) && !empty($makalah->file_artikel))
        <a href="{{ $makalah->getFileArtikelUrl() ?? '' }}" target="_blank">
            <i class="fa fa-file-pdf text-danger"></i>
            Download
        </a>
    @endif
</div>
