@extends('layouts.app')


@section('content')
<h1>Hello   {{$title}} </h1>

@if (count($service)>0)
<ul  class="list-group">
    @foreach ($service as $item)
        <li class="list-group-item">{{$item}}</li>
    @endforeach
</ul>

@endif

@endsection


