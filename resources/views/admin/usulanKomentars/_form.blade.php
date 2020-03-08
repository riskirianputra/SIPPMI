{{ html()->form('POST', route('admin.usulan.komentars.store', [$penelitian->id]))->open() }}

{{ html()->hidden('penelitian_id', $penelitian->id) }}

<div class="form-group">
    <label for="komentar">Komentar</label>
    {{ html()->textarea('komentar')->id('komentar')->class('form-control') }}
</div>

{{ html()->submit('Simpan')->class(['btn', 'btn-primary', 'btn-small', 'btn-sm']) }}

{{ html()->form()->close() }}
