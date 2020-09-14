@extends('egitmenler.layouts.auth')
@section('title', 'Parola Sıfırlama')

@section('content')
        <div class="d-flex justify-content-center align-items-center " style="height: 100vh">
            <div class="auth-form p-5 border border-5 bg-royal-blue text-white" style="border-radius: 2em;">
                <h1 class="text-center auth-form-title">Parola Sıfırlama</h1>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label>Email Adresi</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback text-white" role="alert">
                                        <strong>{{ $message }}</strong>
                         </span>
                        @enderror
                    </div>

                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label>Parola</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                        <span class="invalid-feedback text-white" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label>Parola Onayla</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" class="form-control btn btn-success  col-lg-6 col-md-6 col-12" value="Parola Sıfırla">
                    </div>
                </form>

            </div>
        </div>
@endsection

