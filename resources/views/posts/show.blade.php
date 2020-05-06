@extends ('layouts.app')

@section('content')

<div class = "float-right"><a href="{{ url('posts') }}" class="btn btn-warning">Go Back</a></div>

<h1>{{$post->title}}</h1>
<div class ="card">
    <div style="width:100%; text-align:center">
    <br/>
<img style="width:30%" src="{{$post->c_image}}">
<br>
<br>
    </div>
</div>
<br>
<div class ="card">
    <div style="width:100%; text-align:center">
    <br>
    {!!$post->body!!}
    <br>
    <br>
    </div>
</div>
<hr>
<small>Written on {{$post->created_at}}</small>
<hr>
{{--}}This will prevent guest from seeing the edit and delete buttons{{--}}
@if(!Auth::guest())
{{--}}This will prevent other users from seeing the edit and delete buttons{{--}}    
@if(Auth::user()->id == $post->user_id)
   <a href="{{url("edit/{$post->id}")}}" class="btn btn-info">Edit</a>
    <div class = "float-right">
    {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
    {{form::hidden('_method', 'DELETE')}}
    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
    {!!Form::close()!!}
    </div>
@endif
@endif
@endsection
