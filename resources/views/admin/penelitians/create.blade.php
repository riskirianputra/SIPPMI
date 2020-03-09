@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.penelitian.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.penelitians.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="judul">{{ trans('cruds.penelitian.fields.judul') }}</label>
                <input class="form-control {{ $errors->has('judul') ? 'is-invalid' : '' }}" type="text" name="judul" id="judul" value="{{ old('judul', '') }}" required>
                @if($errors->has('judul'))
                    <div class="invalid-feedback">
                        {{ $errors->first('judul') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.penelitian.fields.judul_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="skema_id">{{ trans('cruds.penelitian.fields.skema') }}</label>
                <select class="form-control select2 {{ $errors->has('skema') ? 'is-invalid' : '' }}" name="skema_id" id="skema_id">
                    @foreach($skemas as $id => $skema)
                        <option value="{{ $id }}" {{ old('skema_id') == $id ? 'selected' : '' }}>{{ $skema }}</option>
                    @endforeach
                </select>
                @if($errors->has('skema_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('skema_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.penelitian.fields.skema_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="kode_rumpun_id">{{ trans('cruds.penelitian.fields.kode_rumpun') }}</label>
                <select class="form-control select2 {{ $errors->has('kode_rumpun') ? 'is-invalid' : '' }}" name="kode_rumpun_id" id="kode_rumpun_id">
                    @foreach($kode_rumpuns as $id => $kode_rumpun)
                        <option value="{{ $id }}" {{ old('kode_rumpun_id') == $id ? 'selected' : '' }}>{{ $kode_rumpun }}</option>
                    @endforeach
                </select>
                @if($errors->has('kode_rumpun_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kode_rumpun_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.penelitian.fields.kode_rumpun_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="prodi_id">{{ trans('cruds.penelitian.fields.prodi') }}</label>
                <select class="form-control select2 {{ $errors->has('prodi') ? 'is-invalid' : '' }}" name="prodi_id" id="prodi_id" required>
                    @foreach($prodis as $id => $prodi)
                        <option value="{{ $id }}" {{ old('prodi_id') == $id ? 'selected' : '' }}>{{ $prodi }}</option>
                    @endforeach
                </select>
                @if($errors->has('prodi_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('prodi_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.penelitian.fields.prodi_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tahapan_id">{{ trans('cruds.penelitian.fields.tahapan') }}</label>
                <select class="form-control select2 {{ $errors->has('tahapan') ? 'is-invalid' : '' }}" name="tahapan_id" id="tahapan_id">
                    @foreach($tahapans as $id => $tahapan)
                        <option value="{{ $id }}" {{ old('tahapan_id') == $id ? 'selected' : '' }}>{{ $tahapan }}</option>
                    @endforeach
                </select>
                @if($errors->has('tahapan_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tahapan_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.penelitian.fields.tahapan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ringkasan_eksekutif">{{ trans('cruds.penelitian.fields.ringkasan_eksekutif') }}</label>
                <textarea class="form-control {{ $errors->has('ringkasan_eksekutif') ? 'is-invalid' : '' }}" name="ringkasan_eksekutif" id="ringkasan_eksekutif">{{ old('ringkasan_eksekutif') }}</textarea>
                @if($errors->has('ringkasan_eksekutif'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ringkasan_eksekutif') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.penelitian.fields.ringkasan_eksekutif_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.penelitian.fields.multi_tahun') }}</label>
                <select class="form-control {{ $errors->has('multi_tahun') ? 'is-invalid' : '' }}" name="multi_tahun" id="multi_tahun">
                    <option value disabled {{ old('multi_tahun', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Penelitian::MULTI_TAHUN_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('multi_tahun', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('multi_tahun'))
                    <div class="invalid-feedback">
                        {{ $errors->first('multi_tahun') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.penelitian.fields.multi_tahun_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tahun_ke">{{ trans('cruds.penelitian.fields.tahun_ke') }}</label>
                <input class="form-control {{ $errors->has('tahun_ke') ? 'is-invalid' : '' }}" type="number" name="tahun_ke" id="tahun_ke" value="{{ old('tahun_ke') }}" step="1">
                @if($errors->has('tahun_ke'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tahun_ke') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.penelitian.fields.tahun_ke_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="biaya">{{ trans('cruds.penelitian.fields.biaya') }}</label>
                <input class="form-control {{ $errors->has('biaya') ? 'is-invalid' : '' }}" type="number" name="biaya" id="biaya" value="{{ old('biaya') }}" step="0.01">
                @if($errors->has('biaya'))
                    <div class="invalid-feedback">
                        {{ $errors->first('biaya') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.penelitian.fields.biaya_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="file_proposal">{{ trans('cruds.penelitian.fields.file_proposal') }}</label>
                <div class="needsclick dropzone {{ $errors->has('file_proposal') ? 'is-invalid' : '' }}" id="file_proposal-dropzone">
                </div>
                @if($errors->has('file_proposal'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file_proposal') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.penelitian.fields.file_proposal_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="file_laporan_kemajuan">{{ trans('cruds.penelitian.fields.file_laporan_kemajuan') }}</label>
                <div class="needsclick dropzone {{ $errors->has('file_laporan_kemajuan') ? 'is-invalid' : '' }}" id="file_laporan_kemajuan-dropzone">
                </div>
                @if($errors->has('file_laporan_kemajuan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file_laporan_kemajuan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.penelitian.fields.file_laporan_kemajuan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="file_laporan_keuangan">{{ trans('cruds.penelitian.fields.file_laporan_keuangan') }}</label>
                <div class="needsclick dropzone {{ $errors->has('file_laporan_keuangan') ? 'is-invalid' : '' }}" id="file_laporan_keuangan-dropzone">
                </div>
                @if($errors->has('file_laporan_keuangan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file_laporan_keuangan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.penelitian.fields.file_laporan_keuangan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="file_profil_penelitian">{{ trans('cruds.penelitian.fields.file_profil_penelitian') }}</label>
                <div class="needsclick dropzone {{ $errors->has('file_profil_penelitian') ? 'is-invalid' : '' }}" id="file_profil_penelitian-dropzone">
                </div>
                @if($errors->has('file_profil_penelitian'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file_profil_penelitian') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.penelitian.fields.file_profil_penelitian_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="file_laporan_akhir">{{ trans('cruds.penelitian.fields.file_laporan_akhir') }}</label>
                <div class="needsclick dropzone {{ $errors->has('file_laporan_akhir') ? 'is-invalid' : '' }}" id="file_laporan_akhir-dropzone">
                </div>
                @if($errors->has('file_laporan_akhir'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file_laporan_akhir') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.penelitian.fields.file_laporan_akhir_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="file_logbook">{{ trans('cruds.penelitian.fields.file_logbook') }}</label>
                <div class="needsclick dropzone {{ $errors->has('file_logbook') ? 'is-invalid' : '' }}" id="file_logbook-dropzone">
                </div>
                @if($errors->has('file_logbook'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file_logbook') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.penelitian.fields.file_logbook_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.fileProposalDropzone = {
    url: '{{ route('admin.penelitians.storeMedia') }}',
    maxFilesize: 50, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 50
    },
    success: function (file, response) {
      $('form').find('input[name="file_proposal"]').remove()
      $('form').append('<input type="hidden" name="file_proposal" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="file_proposal"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($penelitian) && $penelitian->file_proposal)
      var file = {!! json_encode($penelitian->file_proposal) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="file_proposal" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
<script>
    Dropzone.options.fileLaporanKemajuanDropzone = {
    url: '{{ route('admin.penelitians.storeMedia') }}',
    maxFilesize: 10, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
    },
    success: function (file, response) {
      $('form').find('input[name="file_laporan_kemajuan"]').remove()
      $('form').append('<input type="hidden" name="file_laporan_kemajuan" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="file_laporan_kemajuan"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($penelitian) && $penelitian->file_laporan_kemajuan)
      var file = {!! json_encode($penelitian->file_laporan_kemajuan) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="file_laporan_kemajuan" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
<script>
    Dropzone.options.fileLaporanKeuanganDropzone = {
    url: '{{ route('admin.penelitians.storeMedia') }}',
    maxFilesize: 10, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
    },
    success: function (file, response) {
      $('form').find('input[name="file_laporan_keuangan"]').remove()
      $('form').append('<input type="hidden" name="file_laporan_keuangan" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="file_laporan_keuangan"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($penelitian) && $penelitian->file_laporan_keuangan)
      var file = {!! json_encode($penelitian->file_laporan_keuangan) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="file_laporan_keuangan" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
<script>
    Dropzone.options.fileProfilPenelitianDropzone = {
    url: '{{ route('admin.penelitians.storeMedia') }}',
    maxFilesize: 10, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
    },
    success: function (file, response) {
      $('form').find('input[name="file_profil_penelitian"]').remove()
      $('form').append('<input type="hidden" name="file_profil_penelitian" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="file_profil_penelitian"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($penelitian) && $penelitian->file_profil_penelitian)
      var file = {!! json_encode($penelitian->file_profil_penelitian) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="file_profil_penelitian" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
<script>
    Dropzone.options.fileLaporanAkhirDropzone = {
    url: '{{ route('admin.penelitians.storeMedia') }}',
    maxFilesize: 2, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').find('input[name="file_laporan_akhir"]').remove()
      $('form').append('<input type="hidden" name="file_laporan_akhir" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="file_laporan_akhir"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($penelitian) && $penelitian->file_laporan_akhir)
      var file = {!! json_encode($penelitian->file_laporan_akhir) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="file_laporan_akhir" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
<script>
    Dropzone.options.fileLogbookDropzone = {
    url: '{{ route('admin.penelitians.storeMedia') }}',
    maxFilesize: 5, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
    },
    success: function (file, response) {
      $('form').find('input[name="file_logbook"]').remove()
      $('form').append('<input type="hidden" name="file_logbook" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="file_logbook"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($penelitian) && $penelitian->file_logbook)
      var file = {!! json_encode($penelitian->file_logbook) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="file_logbook" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection