@extends('egitmenler.layouts.app')
@section('title', $egitmen->adi)

@section('content')
        <egitmen-detay-w :egitmen="{{$egitmen}}" :aktif_user_id="{{ auth()->id() }}"></egitmen-detay-w>
@endsection
