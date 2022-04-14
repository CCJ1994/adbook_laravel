<!-- resources/views/child.blade.php -->
@extends('layouts.layout')

@section('title', $menus['name'])

@section('content')

@include('page.'.$menus['url'])

@endsection
