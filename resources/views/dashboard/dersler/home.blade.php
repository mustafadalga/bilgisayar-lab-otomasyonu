@extends('dashboard.layouts.app')
@section('title', 'Dersler')


@section('content')
    <div class="container">
        <dersler-d :dersler="{{ $dersler }}"></dersler-d>
    </div>
@endsection
