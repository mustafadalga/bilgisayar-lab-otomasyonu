@extends('dashboard.layouts.app')
@section('title', $egitmen->adi)


@section('content')
        <div class="container">
            <egitmen-duzenle-d :egitmen="{{ $egitmen }}"></egitmen-duzenle-d>
        </div>
@endsection

