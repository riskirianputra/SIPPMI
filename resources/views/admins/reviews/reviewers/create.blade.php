@can('reviewer_manage')
    <form method="POST" class="form-inline" action="{{ route("admin.reviewers.store") }}" class="form-inline"
          enctype="multipart/form-data">
        @csrf

        <label class="required font-weight-bold my-1 mr-sm-2 text-right">{{ trans('cruds.dosen.title') }}</label>

        <select class="custom-select select2 {{ $errors->has('id') ? 'is-invalid' : '' }}" name="id" id="id" required>
            <option value
                    disabled {{ old('id', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
            @foreach($dosens as $key => $label)
                <option
                    value="{{ $key }}" {{ old('status', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        @if($errors->has('status'))
            <div class="invalid-feedback">
                {{ $errors->first('status') }}
            </div>
        @endif

        <button class="btn btn-primary ml-2" type="submit">
            {{ trans('global.save') }}
        </button>

    </form>
@endcan

