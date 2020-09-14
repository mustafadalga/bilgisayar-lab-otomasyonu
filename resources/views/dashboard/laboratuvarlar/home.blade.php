@extends('dashboard.layouts.app')
@section('title','Laboratuvarlar')

@section('content')
    <laboratuvarlar-d :labs="{{ $laboratuvarlar }}"></laboratuvarlar-d>
@endsection
