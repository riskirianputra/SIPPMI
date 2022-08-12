<form method="POST" action="{{ route("admin.plotting-reviewers.filter") }}" class="mt-3">
    @csrf
    <div class="form-group row">
        <label for="tahapan" class="required font-weight-bold col-sm-2">{{ trans('cruds.tahapanReview.title') }}</label>
        <div class="col-sm-10">
            <select class="form-control mr-sm-2 {{ $errors->has('tahapan') ? 'is-invalid' : '' }}" name="tahapan"
                    id="tahapan" required>
                <option value
                        disabled {{ old('tahapan', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                @foreach($tahapanRiview as $key => $label)
                    <option
                        value="{{ $key }}" {{ old('tahapan', $tahapan_id ?? '') == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            @if($errors->has('tahapan'))
                <div class="invalid-feedback">
                    {{ $errors->first('tahapan') }}
                </div>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label class="required font-weight-bold col-sm-2">{{ trans('cruds.refSkema.title') }}</label>
        <div class="col-sm-10">
            <select class="form-control {{ $errors->has('skema') ? 'is-invalid' : '' }}" name="skema" id="skema"
                    required>
                <option value
                        disabled {{ old('skema', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                @foreach($skemas as $key => $label)
                    <option
                        value="{{ $key }}" {{ old('skema', $skema_id ?? '') == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            @if($errors->has('skema'))
                <div class="invalid-feedback">
                    {{ $errors->first('skema') }}
                </div>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </div>
</form>
