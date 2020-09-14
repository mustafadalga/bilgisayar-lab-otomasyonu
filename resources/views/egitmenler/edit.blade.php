@extends('egitmenler.layouts.app')
@section('title', $egitmen->adi)

@section('content')
    <egitmen-duzenle-w :egitmen="{{ $egitmen }}"></egitmen-duzenle-w>
@endsection

