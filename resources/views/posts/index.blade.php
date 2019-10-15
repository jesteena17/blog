@extends('layouts.app')
@section('content')
@if (count($posts)>0)
@foreach ($posts as $post)
<div class="list-group-item">
<a href="/posts/{{$post->id}}" style="text-decoration:none">   {{$post->title}} </a>
<hr>

<img src="{{$path}}/{{$post->cover_image}}" width="300px" height="300px"/>


<hr>
Created at..{{$post->created_at}} by  {{$post->user->name}}
</div>
@endforeach

{{$posts->links() }}
@else
<h3>No posts found</h3>
@endif
@endsection





