@extends('egitmenler.layouts.app')
@section('title', 'Laboratuvarlar')

@section('content')
    <div class="mt-5">
        <laboratuvarlar-w :labs="{{ $laboratuvarlar }}"></laboratuvarlar-w>
    </div>
@endsection
