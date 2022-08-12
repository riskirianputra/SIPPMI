<!-- Input (Select) Jenis Usulan -->
<div class="form-group">
    <label class="form-label" for="jenis_usulan">Jenis Usulan</label>
    {{ html()->select('jenis_usulan')->options(App\RefSkema::JENIS_USULAN_SELECT)->class(["form-control", "is-invalid" => $errors->has('jenis_usulan')])->id('jenis_usulan')->placeholder('-- Jenis Usulan --') }}
    @error('jenis_usulan')
    <div class="invalid-feedback">{{ $errors->first('jenis_usulan') }}</div>
    @enderror
</div>

<!-- Text Field Input for Nama Skema -->
<div class="form-group">
    <label class="form-label" for="nama">Nama Skema</label>
    {{ html()->text('nama')->class(["form-control", "is-invalid" => $errors->has('nama')])->id('nama')->placeholder('Nama Skema Usulan') }}
    @error('nama')
    <div class="invalid-feedback">{{ $errors->first('nama') }}</div>
    @enderror
</div>

<!-- Text Field Input for Jangka Waktu -->
<div class="form-group">
    <label class="form-label" for="jangka_waktu">Jangka Waktu</label>
    {{ html()->text('jangka_waktu')->class(["form-control", "is-invalid" => $errors->has('jangka_waktu')])->id('jangka_waktu')->placeholder('Jangka waktu maksimal penelitian (dalam tahun) ') }}
    @error('jangka_waktu')
    <div class="invalid-feedback">{{ $errors->first('jangka_waktu') }}</div>
    @enderror
</div>

<!-- Text Field Input for Biaya Minimal -->
<div class="form-group">
    <label class="form-label" for="biaya_minimal">Biaya Minimal (Rp)</label>
    {{ html()->text('biaya_minimal')->class(["form-control", "is-invalid" => $errors->has('biaya_minimal')])->id('biaya_minimal')->placeholder('Minimal Biaya yang diizinkan untuk Skema ini (tanpa titik, koma)') }}
    @error('biaya_minimal')
    <div class="invalid-feedback">{{ $errors->first('biaya_minimal') }}</div>
    @enderror
</div>

<!-- Text Field Input for Biaya Maksimal (Rp) -->
<div class="form-group">
    <label class="form-label" for="biaya_maksimal">Biaya Maksimal (Rp)</label>
    {{ html()->text('biaya_maksimal')->class(["form-control", "is-invalid" => $errors->has('biaya_maksimal')])->id('biaya_maksimal')->placeholder('Maksimal Biaya yang diizinkan untuk Skema ini (tanpa titik, koma)') }}
    @error('biaya_maksimal')
    <div class="invalid-feedback">{{ $errors->first('biaya_maksimal') }}</div>
    @enderror
</div>

<!-- Text Field Input for Sumber Dana -->
<div class="form-group">
    <label class="form-label" for="sumber_dana">Sumber Dana</label>
    {{ html()->text('sumber_dana')->class(["form-control", "is-invalid" => $errors->has('sumber_dana')])->id('sumber_dana')->placeholder('Sumber Dana Penelitian') }}
    @error('sumber_dana')
    <div class="invalid-feedback">{{ $errors->first('sumber_dana') }}</div>
    @enderror
</div>

<!-- Text Field Input for Jumlah Peneliti (Minimal) -->
<div class="form-group">
    <label class="form-label" for="anggota_min">Jumlah Peneliti Minimal (termasuk Ketua)</label>
    {{ html()->text('anggota_min')->class(["form-control", "is-invalid" => $errors->has('anggota_min')])->id('anggota_min')->placeholder('Jumlah Peneliti Minimal (termasuk ketua)') }}
    @error('anggota_min')
    <div class="invalid-feedback">{{ $errors->first('anggota_min') }}</div>
    @enderror
</div>

<!-- Text Field Input for Jumlah Peneliti (Maksimal) -->
<div class="form-group">
    <label class="form-label" for="anggota_max">Jumlah Peneliti Maksimal (termasuk Ketua)</label>
    {{ html()->text('anggota_max')->class(["form-control", "is-invalid" => $errors->has('anggota_max')])->id('anggota_max')->placeholder('Jumlah Peneliti Maksimal (termasuk Ketua)') }}
    @error('anggota_max')
    <div class="invalid-feedback">{{ $errors->first('anggota_max') }}</div>
    @enderror
</div>

<!-- Text Field Input for Jumlah Anggota Mahasiswa Minimal -->
<div class="form-group">
    <label class="form-label" for="mahasiswa_min">Jumlah Mahasiswa Minimal</label>
    {{ html()->text('mahasiswa_min')->class(["form-control", "is-invalid" => $errors->has('mahasiswa_min')])->id('mahasiswa_min')->placeholder('Jumlah minimal mahasiswa sebagai anggota') }}
    @error('mahasiswa_min')
    <div class="invalid-feedback">{{ $errors->first('mahasiswa_min') }}</div>
    @enderror
</div>

<!-- Text Field Input for Jumlah Mahasiswa Maksimal -->
<div class="form-group">
    <label class="form-label" for="mahasiswa_max">Jumlah Mahasiswa Maksimal</label>
    {{ html()->text('mahasiswa_max')->class(["form-control", "is-invalid" => $errors->has('mahasiswa_max')])->id('mahasiswa_max')->placeholder('Jumlah Maksimal mahasiswa sebagai anggota') }}
    @error('mahasiswa_max')
    <div class="invalid-feedback">{{ $errors->first('mahasiswa_max') }}</div>
    @enderror
</div>

<div class="row">

    <div class="col-sm">
        <!-- Text Field Input for Tanggal Mulai Submit Proposal -->
        <div class="form-group">
            <label class="form-label" for="tanggal_mulai">Tanggal Mulai Submit Proposal</label>
            {{ html()->date('tanggal_mulai')->class(["form-control", "is-invalid" => $errors->has('tanggal_mulai')])->id('tanggal_mulai') }}
            @error('tanggal_mulai')
            <div class="invalid-feedback">{{ $errors->first('tanggal_mulai') }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm">
        <!-- Text Field Input for Tanggal Akhir Submit Proposal  -->
        <div class="form-group">
            <label class="form-label" for="tanggal_mulai">Tanggal Akhir Submit Proposal</label>
            {{ html()->date('tanggal_selesai')->class(["form-control", "is-invalid" => $errors->has('tanggal_selesai')])->id('tanggal_selesai') }}
            @error('tanggal_selesai')
            <div class="invalid-feedback">{{ $errors->first('tanggal_selesai') }}</div>
            @enderror
        </div>
    </div>

</div>
