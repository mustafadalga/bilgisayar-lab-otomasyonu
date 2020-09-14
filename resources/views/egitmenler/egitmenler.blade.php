@extends('egitmenler.layouts.app')

@section('content')
    <div class="mt-3">
        <egitmenler-w :egitmenler="{{ $egitmenler }}"></egitmenler-w>
    </div>
@endsection
