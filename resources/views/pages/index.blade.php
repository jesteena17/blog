@extends('layouts.app')


@section('content')


<div class="jumbotron">
        <h1>Welcome to {{$title}}</h1>
        {{-- (or) --}}
<h1><?php  echo $title;  ?></h1>

<p>Laravel is super framework</p>

<a href="/register"  class="btn btn-success btn-lg" role="button">Register</a>
<a href="/login" class="btn btn-info btn-lg" role="button">Login</a>
</div>


@endsection

