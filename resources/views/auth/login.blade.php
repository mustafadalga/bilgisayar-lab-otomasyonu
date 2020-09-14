@extends('egitmenler.layouts.auth')
@section('title', 'Eğitmen Girişi')

@section('content')
    <login-w password_reset_status="{{  session('status') }}"></login-w>
@endsection
