@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You're logged in!
                </div>
                @if(Auth::check() && !Auth::user()->role)
                <div class="panel-body">
                    <div class = "float-right">
                    <a href="{{route('create')}}" class="btn btn-dark">Create a Post</a>
                    </div>
                    <br>
                    <br>
                    <br>
                    <h4>Your Found lost item Posts</h4>
                    @if(count($posts) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Lost Item Title</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{$post->title}}</td>
                                    <td><a href="{{url("edit/{$post->id}")}}" class="btn btn-primary">Edit</a></td>
                                    <td>
                                        {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                        {!!Form::close()!!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>You have no posts</p>
                    @endif
                    @endif
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
