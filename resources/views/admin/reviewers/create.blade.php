@can('reviewer_manage')
<form method="POST" class="form-inline" action="{{ route("admin.reviewers.store") }}" enctype="multipart/form-data">
    @csrf
    <table width="100%">
        <tr>
            <td width="10%">
                <label class="required font-weight-bold my-1 mr-sm-2 text-right">{{ trans('cruds.dosen.title') }}</label>
            </td>
            <td width="70%">
                <select class="custom-select select2 {{ $errors->has('id') ? 'is-invalid' : '' }}" name="id" id="id" required>
                    <option value disabled {{ old('id', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach($dosens as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.reviewer.fields.status_helper') }}</span>
            </td>
            <td width="20%">
                <button class="btn btn-danger ml-sm-2" type="submit">
                    {{ trans('global.save') }}
                </button>
            </td>
        </tr>
    </table>
</form>
@endcan

