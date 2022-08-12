{{ html()->form('POST', route('admin.monitoring-reviews.post_progress'))->open() }}

<!-- Input (Select) Tahun -->
<div class="form-group">
    <label class="form-label" for="tahun">Tahun</label>
    {{ html()->select('tahun', $tahuns, old('tahun', $tahun ?? 0))->class(["form-control", "is-invalid" => $errors->has('tahun')])->id('tahun')->placeholder('') }}
    @error('tahun')
    <div class="invalid-feedback">{{ $errors->first('tahun') }}</div>
    @enderror
</div>

<!-- Input (Select) Tahapan -->
<div class="form-group">
    <label class="form-label" for="tahapan">Tahapan</label>
    {{ html()->select('tahapan', $tahapans, old('tahapan', $tahapan ?? 0))->class(["form-control", "is-invalid" => $errors->has('tahapan')])->id('tahapan') }}
    @error('tahapan')
    <div class="invalid-feedback">{{ $errors->first('tahapan') }}</div>
    @enderror
</div>

<!-- Input (Select) Skema Usulan -->
<div class="form-group">
    <label class="form-label" for="skema">Skema Usulan</label>
    {{ html()->select('skema', $skemas, old('skema', $skema ?? 0))->class(["form-control select2", "is-invalid" => $errors->has('skema')])->id('skema')->placeholder('') }}
    @error('skema')
    <div class="invalid-feedback">{{ $errors->first('skema') }}</div>
    @enderror
</div>

<div class="form-group">
    <label class="form-label" for="export">Export Excel?
        <input name="export" type="checkbox">
    </label>
</div>

{{ html()->submit('Filter/Export')->class('btn btn-primary ml-sm-2') }}

