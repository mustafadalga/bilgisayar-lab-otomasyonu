@extends('egitmenler.layouts.app')
@section('title', 'Ayarlar')

@section('content')
    <ayarlar-w user="{{ auth()->user() }}"></ayarlar-w>
@endsection

