@extends('egitmenler.layouts.app')
@section('title', 'E-posta Doğrulama')


@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-royal-blue text-white">Eposta adresinizi doğrulayın</div>

                <div class="card-body p-5">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            E-posta adresinize yeni bir doğrulama bağlantısı gönderildi.
                        </div>
                    @endif
                    Devam etmeden önce, lütfen bir doğrulama bağlantısı için e-postanızı kontrol edin.
                        E-postayı almadıysanız
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">başka bir tane istemek için burayı tıklayın</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
