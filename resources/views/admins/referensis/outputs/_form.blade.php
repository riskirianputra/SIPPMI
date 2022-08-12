<!-- Text Field Input for Kode -->
<div class="form-group">
    <label class="form-label" for="code">Kode</label>
    {{ html()->text('code')->class(["form-control", "is-invalid" => $errors->has('code')])->id('code')->placeholder('Kode Output') }}
    @error('code')
    <div class="invalid-feedback">{{ $errors->first('code') }}</div>
    @enderror
</div>

<!-- Input (Select) Jenis Usulan -->
<div class="form-group">
    <label class="form-label" for="jenis_usulan">Jenis Usulan</label>
    {{ html()->select('jenis_usulan')->options(App\Usulan::JENIS_USULAN)->class(["form-control", "is-invalid" => $errors->has('jenis_usulan')])->id('jenis_usulan')->placeholder('-- Jenis Usulan --') }}
    @error('jenis_usulan')
    <div class="invalid-feedback">{{ $errors->first('jenis_usulan') }}</div>
    @enderror
</div>

<!-- Text Field Input for Luaran/Output -->
<div class="form-group">
    <label class="form-label" for="luaran">Luaran/Output</label>
    {{ html()->text('luaran')->class(["form-control", "is-invalid" => $errors->has('luaran')])->id('luaran')->placeholder('-- Output yang diharapkan. ex: jurnal, HaKI') }}
    @error('luaran')
    <div class="invalid-feedback">{{ $errors->first('luaran') }}</div>
    @enderror
</div>

