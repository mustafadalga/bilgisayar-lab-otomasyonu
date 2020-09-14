@extends('dashboard.layouts.app')
@section('title', 'Eğitmenler')


@section('content')
    <div class="container">
        <egitmenler-d :egitmenler="{{ $egitmenler }}" ></egitmenler-d>
    </div>
@endsection
