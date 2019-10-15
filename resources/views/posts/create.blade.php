@extends('layouts.app')

@section('content')



{{ Form::open(['action'=>'PostsController@store','method'=>'POST','enctype'=>'multipart/form-data']) }}
<div class="form-group">
    <?php echo Form::label('title', 'Title', ['class' => 'awesome']);  ?>
    <?php echo Form::text('posttitle', '',['class' => 'form-control','placeholder'=>'Enter Post title']); ?>
</div>
<div class="form-group">
    <?php echo Form::label('body', 'Body', ['class' => 'awesome']);  ?>
    <?php echo Form::textarea('postbody', '',['id'=>'article-ckeditor', 'class' => 'form-control','placeholder'=>'Enter Post body content']); ?>
</div>

<div class="form-group">
    <?php echo Form::label('photo', 'Photo', ['class' => 'awesome']);  ?>
    <?php echo Form::file('cover_image'); ?>
</div>



<div class="form-group">
    <?php echo Form::submit('Submit',['class'=>'btn btn-success']); ?>
</div>
{{ Form::close() }}


@endsection
