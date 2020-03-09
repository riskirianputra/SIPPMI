@extends('layouts.admin')
@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Pengabdian' => route('admin.pengabdians.index'),
        'Edit' => '#'
    ]) !!}
@stop
@section('toolbar')
    @can('pengabdian_view')
        {!! cui_toolbar_btn(route('admin.pengabdians.index'), 'icon-list', trans('global.list').' '.trans('cruds.pengabdian.title_singular') ) !!}
    @endcan
@stop
@section('content')
<div class="col">
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    {{ trans('global.edit') }} {{ trans('cruds.pengabdian.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("admin.pengabdians.update", [$pengabdian->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="judul">{{ trans('cruds.pengabdian.fields.judul') }}</label>
                            <input class="form-control {{ $errors->has('judul') ? 'is-invalid' : '' }}" type="text" name="judul" id="judul" value="{{ old('judul', $pengabdian->judul) }}" required>
                            @if($errors->has('judul'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('judul') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pengabdian.fields.judul_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="mitra_pengabdian">{{ trans('cruds.pengabdian.fields.mitra_pengabdian') }}</label>
                            <input class="form-control {{ $errors->has('mitra_pengabdian') ? 'is-invalid' : '' }}" type="text" name="mitra_pengabdian" id="mitra_pengabdian" value="{{ old('mitra_pengabdian', $pengabdian->mitra_pengabdian) }}">
                            @if($errors->has('mitra_pengabdian'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mitra_pengabdian') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pengabdian.fields.mitra_pengabdian_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="skema_id">{{ trans('cruds.pengabdian.fields.skema') }}</label>
                            <select class="form-control select2 {{ $errors->has('skema') ? 'is-invalid' : '' }}" name="skema_id" id="skema_id" required>
                                @foreach($skemas as $id => $skema)
                                    <option value="{{ $id }}" {{ ($pengabdian->skema ? $pengabdian->skema->id : old('skema_id')) == $id ? 'selected' : '' }}>{{ $skema }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('skema_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('skema_id') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pengabdian.fields.skema_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="prodi_id">{{ trans('cruds.pengabdian.fields.prodi') }}</label>
                            <select class="form-control select2 {{ $errors->has('prodi') ? 'is-invalid' : '' }}" name="prodi_id" id="prodi_id">
                                @foreach($prodis as $id => $prodi)
                                    <option value="{{ $id }}" {{ ($pengabdian->prodi ? $pengabdian->prodi->id : old('prodi_id')) == $id ? 'selected' : '' }}>{{ $prodi }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('prodi_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('prodi_id') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pengabdian.fields.prodi_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="kode_rumpun_id">{{ trans('cruds.pengabdian.fields.kode_rumpun') }}</label>
                            <select class="form-control select2 {{ $errors->has('kode_rumpun') ? 'is-invalid' : '' }}" name="kode_rumpun_id" id="kode_rumpun_id">
                                @foreach($kode_rumpuns as $id => $kode_rumpun)
                                    <option value="{{ $id }}" {{ ($pengabdian->kode_rumpun ? $pengabdian->kode_rumpun->id : old('kode_rumpun_id')) == $id ? 'selected' : '' }}>{{ $kode_rumpun }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('kode_rumpun_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('kode_rumpun_id') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pengabdian.fields.kode_rumpun_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="ringkasan_eksekutif">{{ trans('cruds.pengabdian.fields.ringkasan_eksekutif') }}</label>
                            <textarea class="form-control {{ $errors->has('ringkasan_eksekutif') ? 'is-invalid' : '' }}" name="ringkasan_eksekutif" id="ringkasan_eksekutif">{{ old('ringkasan_eksekutif', $pengabdian->ringkasan_eksekutif) }}</textarea>
                            @if($errors->has('ringkasan_eksekutif'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('ringkasan_eksekutif') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pengabdian.fields.ringkasan_eksekutif_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.pengabdian.fields.multi_tahun') }}</label>
                            <select class="form-control {{ $errors->has('multi_tahun') ? 'is-invalid' : '' }}" name="multi_tahun" id="multi_tahun">
                                <option value disabled {{ old('multi_tahun', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Pengabdian::MULTI_TAHUN_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('multi_tahun', $pengabdian->multi_tahun) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('multi_tahun'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('multi_tahun') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pengabdian.fields.multi_tahun_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="tahun_ke">{{ trans('cruds.pengabdian.fields.tahun_ke') }}</label>
                            <input class="form-control {{ $errors->has('tahun_ke') ? 'is-invalid' : '' }}" type="number" name="tahun_ke" id="tahun_ke" value="{{ old('tahun_ke', $pengabdian->tahun_ke) }}" step="1">
                            @if($errors->has('tahun_ke'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tahun_ke') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pengabdian.fields.tahun_ke_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="biaya">{{ trans('cruds.pengabdian.fields.biaya') }}</label>
                            <input class="form-control {{ $errors->has('biaya') ? 'is-invalid' : '' }}" type="number" name="biaya" id="biaya" value="{{ old('biaya', $pengabdian->biaya) }}" step="0.01">
                            @if($errors->has('biaya'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('biaya') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pengabdian.fields.biaya_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="file_proposal">{{ trans('cruds.pengabdian.fields.file_proposal') }}</label>
                            <div class="needsclick dropzone {{ $errors->has('file_proposal') ? 'is-invalid' : '' }}" id="file_proposal-dropzone">
                            </div>
                            @if($errors->has('file_proposal'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('file_proposal') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pengabdian.fields.file_proposal_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="file_lembaran_pengesahan">{{ trans('cruds.pengabdian.fields.file_lembaran_pengesahan') }}</label>
                            <div class="needsclick dropzone {{ $errors->has('file_lembaran_pengesahan') ? 'is-invalid' : '' }}" id="file_lembaran_pengesahan-dropzone">
                            </div>
                            @if($errors->has('file_lembaran_pengesahan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('file_lembaran_pengesahan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pengabdian.fields.file_lembaran_pengesahan_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="file_laporan_kemajuan">{{ trans('cruds.pengabdian.fields.file_laporan_kemajuan') }}</label>
                            <div class="needsclick dropzone {{ $errors->has('file_laporan_kemajuan') ? 'is-invalid' : '' }}" id="file_laporan_kemajuan-dropzone">
                            </div>
                            @if($errors->has('file_laporan_kemajuan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('file_laporan_kemajuan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pengabdian.fields.file_laporan_kemajuan_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="file_laporan_keuangan">{{ trans('cruds.pengabdian.fields.file_laporan_keuangan') }}</label>
                            <div class="needsclick dropzone {{ $errors->has('file_laporan_keuangan') ? 'is-invalid' : '' }}" id="file_laporan_keuangan-dropzone">
                            </div>
                            @if($errors->has('file_laporan_keuangan'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('file_laporan_keuangan') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pengabdian.fields.file_laporan_keuangan_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="file_laporan_akhir">{{ trans('cruds.pengabdian.fields.file_laporan_akhir') }}</label>
                            <div class="needsclick dropzone {{ $errors->has('file_laporan_akhir') ? 'is-invalid' : '' }}" id="file_laporan_akhir-dropzone">
                            </div>
                            @if($errors->has('file_laporan_akhir'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('file_laporan_akhir') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pengabdian.fields.file_laporan_akhir_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="file_logbook">{{ trans('cruds.pengabdian.fields.file_logbook') }}</label>
                            <div class="needsclick dropzone {{ $errors->has('file_logbook') ? 'is-invalid' : '' }}" id="file_logbook-dropzone">
                            </div>
                            @if($errors->has('file_logbook'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('file_logbook') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pengabdian.fields.file_logbook_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="file_profile_pengabdian">{{ trans('cruds.pengabdian.fields.file_profile_pengabdian') }}</label>
                            <div class="needsclick dropzone {{ $errors->has('file_profile_pengabdian') ? 'is-invalid' : '' }}" id="file_profile_pengabdian-dropzone">
                            </div>
                            @if($errors->has('file_profile_pengabdian'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('file_profile_pengabdian') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pengabdian.fields.file_profile_pengabdian_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    Dropzone.options.fileProposalDropzone = {
    url: '{{ route('admin.pengabdians.storeMedia') }}',
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
@if(isset($pengabdian) && $pengabdian->file_proposal)
      var file = {!! json_encode($pengabdian->file_proposal) !!}
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
    Dropzone.options.fileLembaranPengesahanDropzone = {
    url: '{{ route('admin.pengabdians.storeMedia') }}',
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
      $('form').find('input[name="file_lembaran_pengesahan"]').remove()
      $('form').append('<input type="hidden" name="file_lembaran_pengesahan" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="file_lembaran_pengesahan"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($pengabdian) && $pengabdian->file_lembaran_pengesahan)
      var file = {!! json_encode($pengabdian->file_lembaran_pengesahan) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="file_lembaran_pengesahan" value="' + file.file_name + '">')
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
    url: '{{ route('admin.pengabdians.storeMedia') }}',
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
@if(isset($pengabdian) && $pengabdian->file_laporan_kemajuan)
      var file = {!! json_encode($pengabdian->file_laporan_kemajuan) !!}
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
    url: '{{ route('admin.pengabdians.storeMedia') }}',
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
@if(isset($pengabdian) && $pengabdian->file_laporan_keuangan)
      var file = {!! json_encode($pengabdian->file_laporan_keuangan) !!}
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
    Dropzone.options.fileLaporanAkhirDropzone = {
    url: '{{ route('admin.pengabdians.storeMedia') }}',
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
@if(isset($pengabdian) && $pengabdian->file_laporan_akhir)
      var file = {!! json_encode($pengabdian->file_laporan_akhir) !!}
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
    url: '{{ route('admin.pengabdians.storeMedia') }}',
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
@if(isset($pengabdian) && $pengabdian->file_logbook)
      var file = {!! json_encode($pengabdian->file_logbook) !!}
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
<script>
    Dropzone.options.fileProfilePengabdianDropzone = {
    url: '{{ route('admin.pengabdians.storeMedia') }}',
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
      $('form').find('input[name="file_profile_pengabdian"]').remove()
      $('form').append('<input type="hidden" name="file_profile_pengabdian" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="file_profile_pengabdian"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($pengabdian) && $pengabdian->file_profile_pengabdian)
      var file = {!! json_encode($pengabdian->file_profile_pengabdian) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="file_profile_pengabdian" value="' + file.file_name + '">')
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
