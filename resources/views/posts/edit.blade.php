@extends('layouts.app')

@section('content')



{{ Form::open(['action'=>['PostsController@update',$post->id],'method'=>'POST','enctype'=>'multipart/form-data']) }}
<div class="form-group">
    <?php echo Form::label('title', 'Title', ['class' => 'awesome']);  ?>
    <?php echo Form::text('posttitle', $post->title,['class' => 'form-control','placeholder'=>'Enter Post title']); ?>
</div>
<div class="form-group">
    <?php echo Form::label('body', 'Body', ['class' => 'awesome']);  ?>
    <?php echo Form::textarea('postbody', $post->body,['id'=>'article-ckeditor', 'class' => 'form-control','placeholder'=>'Enter Post body content']); ?>
</div>

<div class="form-group">
    <?php echo Form::label('photo', 'Photo', ['class' => 'awesome']);  ?>
    <?php echo Form::file('cover_image'); ?>
</div>



<div class="form-group">
<?php echo Form::hidden('_method','PUT'); ?>

    <?php echo Form::submit('update',['class'=>'btn btn-success']); ?>
</div>
{{ Form::close() }}


@endsection
