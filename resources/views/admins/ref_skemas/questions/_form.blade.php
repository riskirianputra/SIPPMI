{{ html()->hidden('ref_skema_id')->id('ref_skema_id')->value($refSkema->id)  }}

<div class="form-group">
    <label class="required" for="pertanyaan">Pertanyaan</label>
    {{ html()->hidden('pertanyaan')->id('pertanyaan') }}

    <div id="editor" style="height: 160px">
        {!! old('pertanyaan', optional($question ?? '')->pertanyaan) !!}
    </div>
    @if($errors->has('pertanyaan'))
        <div class="invalid-feedback">
            {{ $errors->first('pertanyaan') }}
        </div>
    @endif
</div>

<!-- Text Field Input for Bobot -->
<div class="form-group">
    <label class="form-label" for="bobot">Bobot (%)</label>
    {{ html()->text('bobot')->class(["form-control", "is-invalid" => $errors->has('bobot')])->id('bobot')->placeholder('Bobot Penilaian dalam %. Contoh : 25') }}
    @error('bobot')
    <div class="invalid-feedback">{{ $errors->first('bobot') }}</div>
    @enderror
</div>

<!-- Input (Select) Tipe Pertanyaan -->
<div class="form-group">
    <label class="form-label" for="tipe_pertanyaan">Tipe Pertanyaan</label>
    {{ html()->select('tipe_pertanyaan')->options(config('sippmi.tipe_pertanyaan'))->class(["form-control", "is-invalid" => $errors->has('tipe_pertanyaan')])->id('tipe_pertanyaan')->placeholder('') }}
    @error('tipe_pertanyaan')
    <div class="invalid-feedback">{{ $errors->first('tipe_pertanyaan') }}</div>
    @enderror
</div>
