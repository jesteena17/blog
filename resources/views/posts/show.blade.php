@extends('layouts.app')

@section('content')


<div class="jumbotron">
        <p class="lead">
                <a class="btn btn-primary btn-lg" href="/posts" role="button">Back</a>
              </p>
    <h1 class="display-4">{!! $post->title !!}</h1>
    <p class="lead">{!! $post->body !!}</p>
    <hr>
    
<img src="{{$path}}/{{$post->cover_image}}" width="300px" height="300px"/>
    <hr class="my-4">
      <p>Writen on.... {!! $post->created_at !!}  by  {{$post->user->name}}</p>
<hr>

<div style="width:auto">
@if(!Auth::guest())
@if (Auth::user()->id==$post->user_id)

<div style="float:left;width:130px">

<a href="/posts/{{$post->id}}/edit" class="btn btn-warning">edit</a>
</div>


<div style="float:right;width:225px">
{{ Form::open(['action'=>['PostsController@destroy',$post->id],'method'=>'POST']) }}
<?php echo Form::hidden('_method','DELETE'); ?>

    <?php echo Form::submit('Delete',['class'=>'btn btn-danger']);?>
{{ Form::close() }}


</div>

@endif 
@endif
  </div>
</div>

@endsection
