<!-- resources/views/child.blade.php -->
@extends('layouts.layout')

@section('title', $data['name'])

@section('content')

@include($data['url'].".".$data['page'])

@endsection

@section('footerScripts')
  @parent
  
@endsection