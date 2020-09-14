@extends('dashboard.layouts.app')
@section('title', $lab->adi)



@section('content')
    <h1>{{ $lab->adi }}</h1>
    <laboratuvar-detay-d :lab="{{$lab}}" :oturumlar="{{ $lab->oturumlar }}"></laboratuvar-detay-d>
@endsection
