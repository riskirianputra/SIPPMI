<div class="form-group">
    <label for="kode">{{ trans('cruds.kodeRumpun.fields.kode') }}</label>
    {!! html()->text('kode')->class(['form-control','col-5',  'is-invalid' => $errors->has('kode')])->id('kode') !!}
    @if($errors->has('kode'))
        <div class="invalid-feedback">
            {{ $errors->first('kode') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.kodeRumpun.fields.kode_helper') }}</span>
</div>

<div class="form-group">
    <label for="rumpun_ilmu">{{ trans('cruds.kodeRumpun.fields.rumpun_ilmu') }}</label>
    {!! html()->text('rumpun_ilmu')->id('rumpun_ilmu')->class(['form-control',  'is-invalid' => $errors->has('rumpun_ilmu')]) !!}
    @if($errors->has('rumpun_ilmu'))
        <div class="invalid-feedback">
            {{ $errors->first('rumpun_ilmu') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.kodeRumpun.fields.rumpun_ilmu_helper') }}</span>
</div>

<div class="form-group">
    <label for="rumpun_ilmu">Level</label>
    {!! html()->text('level')->id('level')->class(['form-control','col-5',  'is-invalid' => $errors->has('level')]) !!}
    @if($errors->has('level'))
        <div class="invalid-feedback">
            {{ $errors->first('level') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.kodeRumpun.fields.rumpun_ilmu_helper') }}</span>
</div>
