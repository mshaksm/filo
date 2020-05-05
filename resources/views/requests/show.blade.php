<!-- page for displaying the request -->
@extends('layouts.app')

@section('content')
<!--Display post title-->
<h1>{{$requests->post->title}}</h1>
<hr>
<a href="/requests" class="btn btn-warning">Back</a>
<br><br>
<h4>Requested by {{$requests->user->name}}</h4>
<br>
<div>
    <b>Reason:</b>
        {!!$requests->reason!!}
</div>
<hr>
<small>Request made on: {{$requests->created_at}}</small>
<hr>
<div>
    <a href="" class="btn btn-primary">Accept</a>
    <a href="" class="btn btn-danger">Decline</a>
</div>
@endsection