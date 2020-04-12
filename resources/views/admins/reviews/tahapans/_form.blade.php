
<!-- Text Field Input for Nama Tahapan -->
<div class="form-group">
    <label class="form-label" for="nama">Nama Tahapan</label>
    {{ html()->text('nama')->class(["form-control", "is-invalid" => $errors->has('nama')])->id('nama')->placeholder('Nama Tahapan Review') }}
    @error('nama')
    <div class="invalid-feedback">{{ $errors->first('nama') }}</div>
    @enderror
</div>

<!-- Input (Select) Jumlah_reviewer -->
<div class="form-group">
    <label class="form-label" for="jumlah_reviewer">Jumlah_reviewer</label>
    {{ html()->select('jumlah_reviewer')->options(App\TahapanReview::JUMLAH_REVIEWER)->class(["form-control", "is-invalid" => $errors->has('jumlah_reviewer')])->id('jumlah_reviewer') }}
    @error('jumlah_reviewer')
    <div class="invalid-feedback">{{ $errors->first('jumlah_reviewer') }}</div>
    @enderror
</div>

<!-- Text Field Input for Tahun -->
<div class="form-group">
    <label class="form-label" for="tahun">Tahun</label>
    {{ html()->text('tahun')->class(["form-control", "is-invalid" => $errors->has('tahun')])->id('tahun')->placeholder('Tahun Penelitian') }}
    @error('tahun')
    <div class="invalid-feedback">{{ $errors->first('tahun') }}</div>
    @enderror
</div>

<!-- Text Field Input for Tanggal Mulai -->
<div class="form-group">
    <label class="form-label" for="mulai">Tanggal Mulai</label>
    {{ html()->date('mulai')->class(["form-control", "is-invalid" => $errors->has('mulai')])->id('mulai') }}
    @error('mulai')
    <div class="invalid-feedback">{{ $errors->first('mulai') }}</div>
    @enderror
</div>

<!-- Text Field Input for Tanggal Selesai -->
<div class="form-group">
    <label class="form-label" for="selesai">Tanggal Selesai</label>
    {{ html()->date('selesai')->class(["form-control", "is-invalid" => $errors->has('selesai')])->id('selesai') }}
    @error('selesai')
    <div class="invalid-feedback">{{ $errors->first('selesai') }}</div>
    @enderror
</div>
