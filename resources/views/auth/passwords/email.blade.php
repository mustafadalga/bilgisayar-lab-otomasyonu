@extends('egitmenler.layouts.auth')
@section('title', 'Parola Sıfırlama')


@section('content')
        <div class="d-flex justify-content-center align-items-center " style="height: 100vh">
            <div class="auth-form p-5 border border-5 bg-royal-blue text-white" style="border-radius: 2em;">
                <h1 class="text-center auth-form-title">Parola Sıfırlama</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}" onsubmit="return false;">
                    @csrf
                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label>Email Adresi</label>
                        <input type="email" id="email" name="email"  class="form-control @error('email') is-invalid @enderror"  placeholder="Email adresiniz..." value="{{ old('email') }}" required autofocus autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback text-white" role="alert">
                                        <strong>{{ $message }}</strong>
                         </span>
                        @enderror
                    </div>
                    <div class="form-group clearfix ">
                        <a href="/login" class="float-left text-white text-decoration-none">Giriş Yap</a>
                        <a href="/register" class="float-right text-white text-decoration-none">Kayıt Ol</a>
                    </div>
                    <div class="form-group  text-center">
                        <input type="submit" class="form-control btn btn-success  col-lg-6 col-md-6 col-12" value="Parola Sıfırlama Linki Gönder">
                    </div>
                </form>

            </div>
        </div>
@endsection
