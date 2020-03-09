{{ html()->modelForm($komentar, 'PUT', route('admin.usulan.komentars.update', [$penelitian->id, $komentar->id]))->open() }}

{{ html()->hidden('penelitian_id', $penelitian->id) }}

<div class="form-group">
    <label for="komentar">Komentar</label>
    {{ html()->textarea('komentar')->id('komentar')->class('form-control') }}
</div>

{{ html()->submit('Simpan')->class(['btn', 'btn-primary', 'btn-small', 'btn-sm']) }}

{{ html()->closeModelForm() }}
