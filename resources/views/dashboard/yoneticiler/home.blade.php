@extends('dashboard.layouts.app')
@section('title','Yöneticiler')

@section('content')
    <yoneticiler-d :yoneticiler="{{ $yoneticiler }}" :role="{{ Auth::user()->role }}"></yoneticiler-d>
@endsection
