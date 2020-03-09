<div class="form-group row">
    <div class="col-sm-2">
        <strong>Judul</strong>
    </div>
    <div class="col-sm-10">
        {!! $pengabdian->judulSimple !!}
        <br>
        <em><small>{{ optional($pengabdian->skema)->nama }}</small></em>
    </div>
</div>


<div class="form-group row">
    <div class="col-sm-2">
        <strong>Program Studi</strong>
    </div>
    <div class="col-sm-10">
        {{ optional($pengabdian->prodi)->nama }}
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-2">
        <strong>Kode Rumpun Ilmu</strong>
    </div>
    <div class="col-sm-10">
        {{ optional($pengabdian->kode_rumpun)->rumpun_ilmu }}
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-2">
        <strong>Status pengabdian</strong>
    </div>
    <div class="col-sm-10">
        <h5><span class="badge badge-{!! $pengabdian->statusTextColor !!}">{{ $pengabdian->statusText }}</span></h5>
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-2">
        <strong>Biaya</strong>
    </div>
    <div class="col-sm-10">
        Rp {{ number_format($pengabdian->biaya, 0, ',', '.').',-' }}
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-2">
        <strong>File</strong>
    </div>
    <div class="col-sm-10">
        <div class="row">
            <div class="col-sm-3">
                <a href="{{ $pengabdian->getFileProposalUrl() }}" target="_blank">
                    <i class="fa fa-file-pdf-o text-danger"></i>
                    Proposal
                </a>
            </div>
            <div class="col-sm-3">
                <a href="{{ $pengabdian->getFileCvUrl() }}" target="_blank">
                    <i class="fa fa-file-pdf-o text-danger"></i>
                    CV
                </a>
            </div>
            <div class="col-sm-3">
                <a href="{{ $pengabdian->getFilePengesahanUrl() }}" target="_blank">
                    <i class="fa fa-file-pdf-o text-danger"></i>
                    Lembaran Pengesahan
                </a>
            </div>
        </div>
    </div>
</div>

