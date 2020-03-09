<form method="POST" class="form-inline" action="{{ route("admin.plotting-reviewers.filter") }}">
    @csrf
    <label class="required font-weight-bold my-1 mr-sm-2">{{ trans('cruds.tahapanReview.title') }}</label>
    <select class="form-control mr-sm-2 {{ $errors->has('tahapan') ? 'is-invalid' : '' }}" name="tahapan" id="tahapan" required>
        <option value disabled {{ old('tahapan', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
        @foreach($tahapanRiview as $key => $label)
            <option value="{{ $key }}" {{ old('tahapan', $tahapan_id ?? '') == $key ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
    </select>
    @if($errors->has('tahapan'))
        <div class="invalid-feedback">
            {{ $errors->first('tahapan') }}
        </div>
    @endif

    <label class="required font-weight-bold my-1 mr-sm-2">{{ trans('cruds.refSkema.title') }}</label>
    <select class="form-control {{ $errors->has('skema') ? 'is-invalid' : '' }}" name="skema" id="skema" required>
        <option value disabled {{ old('skema', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
        @foreach($skemas as $key => $label)
            <option value="{{ $key }}" {{ old('skema', $skema_id ?? '') == $key ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
    </select>
    @if($errors->has('skema'))
        <div class="invalid-feedback">
            {{ $errors->first('skema') }}
        </div>
    @endif

    <button class="btn btn-danger ml-sm-2" type="submit">
        {{ trans('global.filter') }}
    </button>
</form>
