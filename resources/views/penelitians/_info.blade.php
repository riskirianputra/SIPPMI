<div class="form-group row">
    <div class="col-sm-2">
        <strong>Judul</strong>
    </div>
    <div class="col-sm-10">
        {!! $penelitian->judulSimple !!}
        <br>
        <em><small>{{ optional($penelitian->skema)->nama }}</small></em>
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-2">
        <strong>Status Penelitian</strong>
    </div>
    <div class="col-sm-10">
        <h5><span class="badge badge-{!! $penelitian->statusTextColor !!}">{{ $penelitian->statusText }}</span></h5>
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-2">
        <strong>Biaya</strong>
    </div>
    <div class="col-sm-10">
        Rp {{ number_format($penelitian->biaya, 0, ',', '.').',-' }}
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-2">
        <strong>File</strong>
    </div>
    <div class="col-sm-10">
        <div class="row">
            <div class="col-sm-3">
                <a href="{{ $penelitian->getFileProposalUrl() }}" target="_blank">
                    <i class="fa fa-file-pdf-o text-danger"></i>
                    Proposal
                </a>
            </div>
            <div class="col-sm-3">
                <a href="{{ $penelitian->getFileCvUrl() }}" target="_blank">
                    <i class="fa fa-file-pdf-o text-danger"></i>
                    CV
                </a>
            </div>
            <div class="col-sm-3">
                <a href="{{ $penelitian->getFilePengesahanUrl() }}" target="_blank">
                    <i class="fa fa-file-pdf-o text-danger"></i>
                    Lembaran Pengesahan
                </a>
            </div>
        </div>
    </div>
</div>

