{{ html()->form('POST', route('admin.proposal-monitor.dosen-index'))->open() }}

<!-- Input (Select) Tahun -->
<div class="form-group">
    <label class="form-label" for="tahun">Tahun</label>
    {{ html()->select('tahun', $tahuns, old('tahun', $tahun))->class(["form-control", "is-invalid" => $errors->has('tahun')])->id('tahun')->placeholder('') }}
    @error('tahun')
    <div class="invalid-feedback">{{ $errors->first('tahun') }}</div>
    @enderror
</div>

<!-- Input (Select) Jenis Usulan -->
<div class="form-group">
    <label class="form-label" for="jenis_usulan">Jenis Usulan</label>
    {{ html()->select('jenis_usulan', $usulans, $usulan)->class(["form-control", "is-invalid" => $errors->has('jenis_usulan')])->id('jenis_usulan')->placeholder('') }}
    @error('jenis_usulan')
    <div class="invalid-feedback">{{ $errors->first('jenis_usulan') }}</div>
    @enderror
</div>

<div class="form-group">
    <label class="form-label" for="export">Export Excel?
        <input name="export" type="checkbox">
    </label>
</div>

{{ html()->submit('Filter/Export')->class('btn btn-primary ml-sm-2') }}

