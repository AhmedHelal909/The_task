@extends('layouts.app')
@section('title')
Home Page
@endsection

@section('content')
<div class="container">
    <h1 class="text-center">Welcome {{Auth::user()->name}}</h1>
</div>
@endsection
