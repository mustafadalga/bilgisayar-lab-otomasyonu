@extends('egitmenler.layouts.app')
@section('title', 'Dersler')


@section('content')
    <div class="mt-3">
        <dersler-w :dersler="{{ $dersler }}"></dersler-w>
    </div>
@endsection
