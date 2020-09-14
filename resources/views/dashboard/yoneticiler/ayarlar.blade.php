@extends('dashboard.layouts.app')
@section('title','Ayarlar')

@section('content')
    <ayarlar-d user="{{ auth()->user() }}"></ayarlar-d>
@endsection
