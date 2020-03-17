@extends('layouts.admin')

@section('breadcrumb')
    {!! cui()->breadcrumb([
        'Home' => route('user.home'),
        'Profile' => route('profil.show', [$user->id]),
        'Password' => '#'
    ]) !!}
@endsection

@section('toolbar')
    {!! cui()->toolbar_btn(route('profil.show', [$user->id]), 'cil-user', 'Profil') !!}
@endsection

@section('content')

    <div class="card">

        {{ html()->form('PUT', route('password.update'))->open() }}

        <div class="card-header">
            <strong><i class="cil-lock-locked"></i> Ubah Password {{ $user->name }} </strong>
        </div>

        <div class="card-body">

            <div class="form-group">
                <label class="form-label" for="old_password"><strong>Nama</strong></label>
                <div>{{ $user->name }}</div>
            </div>

            <!-- Static Field for Username -->
            <div class="form-group">
                <label class="form-label" for="username"><strong>Username</strong></label>
                <div>{{ $user->username }}</div>
            </div>


            <div class="form-group">
                <label class="form-label" for="old_password"><strong>Email</strong></label>
                <div>{{ $user->email }}</div>
            </div>

            <hr>

            <!-- Text Field Input for Password Lama -->
            <div class="form-group">
                <label class="form-label" for="old_password">Password Lama</label>
                {{ html()->password('old_password')->class(["form-control", "is-invalid" => $errors->has('old_password')])->id('old_password')->placeholder('Masukkan Password Lama') }}
                @error('old_password')
                <div class="invalid-feedback">{{ $errors->first('old_password') }}</div>
                @enderror
            </div>

            <!-- Text Field Input for Password Baru -->
            <div class="form-group">
                <label class="form-label" for="new_password">Password Baru</label>
                {{ html()->password('new_password')->class(["form-control", "is-invalid" => $errors->has('new_password')])->id('new_password')->placeholder('Masukkan Password Baru') }}
                @error('new_password')
                <div class="invalid-feedback">{{ $errors->first('new_password') }}</div>
                @enderror
            </div>

            <!-- Text Field Input for Konfirmasi Password Baru -->
            <div class="form-group">
                <label class="form-label" for="confirm_password">Konfirmasi Password Baru</label>
                {{ html()->password('confirm_password')->class(["form-control", "is-invalid" => $errors->has('confirm_password')])->id('confirm_password')->placeholder('Konfirmasi Password Baru') }}
                @error('confirm_password')
                <div class="invalid-feedback">{{ $errors->first('confirm_password') }}</div>
                @enderror
            </div>


        </div>

        <div class="card-footer">
            <input type="submit" value="Simpan" class="btn btn-primary"/>
        </div>

        {{ html()->form()->close() }}

    </div>

@endsection
