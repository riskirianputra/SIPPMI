<div class="form-group row">
    <div class="col-sm-2">
        <strong>Judul</strong>
    </div>
    <div class="col-sm-10">
        {!! $pemakalah->judulSimple !!}
        <br>
        <em><small>{{ optional($pemakalah->skema)->nama }}</small></em>
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-2">
        <strong>Nama Forum</strong>
    </div>
    <div class="col-sm-10">
        {{ $pemakalah->nama_forum }}
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-2">
        <strong>Tahun</strong>
    </div>
    <div class="col-sm-10">
        {{ $pemakalah->tahun }}
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-2">
        <strong>Penyelenggara</strong>
    </div>
    <div class="col-sm-10">
        {{ $pemakalah->penyelenggara }}
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-2">
        <strong>Tempat / Tanggal</strong>
    </div>
    <div class="col-sm-10">
        {{ $pemakalah->tempat }}, {{ $pemakalah->tanggal_mulai }} s/d {{ $pemakalah->tanggal_selesai }}
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-2">
        <strong>File</strong>
    </div>
    <div class="col-sm-10">
        <a href="{{ $pemakalah->getFileArtikelUrl() }}" target="_blank">
            <i class="fa fa-file-pdf-o text-danger"></i>
            Proposal
        </a>
    </div>
</div>

