<div class="card">
    <div class="card-header">
        <strong><i class="cil-short-text"></i> Pertanyaan Reviewer</strong>
    </div>

    <div class="card-body">
        <div>
            <div class="row">
                <div class="col-sm-7">
                  <strong>Pertanyaan</strong>
                </div>
                <div class="col-sm-2 text-center">
                    <strong>Bobot</strong>
                </div>
                <div class="col-sm-3 text-center">
                    <strong>Aksi</strong>
                </div>
            </div>
            @foreach($questions as $question)
                <div class="row">
                    <div class="col-sm-7">
                        {!! $question->pertanyaan_simple !!}
                    </div>
                    <div class="col-sm-2 text-center">
                        {{ $question->bobot }}
                    </div>
                    <div class="col-sm-3 text-center">
                        {!! cui_btn_edit(route('admin.ref-skemas.questions.edit', [$skema->id, $question->id])) !!}
                        {!! cui_btn_delete(route('admin.ref-skemas.questions.destroy', [$skema->id, $question->id]), 'Anda yakin akan menghapus pertanyaan ini?') !!}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="card-footer">
        <a href="{{ route('admin.ref-skemas.questions.create', [$skema->id]) }}" class="btn btn-sm btn-primary">Tambah Pertanyaan</a>
    </div>

</div>
