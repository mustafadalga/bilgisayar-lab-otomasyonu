@extends('dashboard.layouts.app')
@section('title', $egitmen->adi)



@section('content')
        <div class="container">
            <egitmen-detay-d :egitmen="{{$egitmen}}" ></egitmen-detay-d>
        </div>
@endsection

