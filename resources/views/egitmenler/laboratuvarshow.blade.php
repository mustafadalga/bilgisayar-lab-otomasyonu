@extends('egitmenler.layouts.app')
@section('title', $lab->adi.' laboratuvarı')


@section('content')
    <div class="mb-5">
        <laboratuvar-detay-w :lab="{{$lab}}" :oturumlar="{{ $lab->oturumlar }}" :aktif_egitmen="{{ $aktif_egitmen }}"></laboratuvar-detay-w>
    </div>
@endsection
