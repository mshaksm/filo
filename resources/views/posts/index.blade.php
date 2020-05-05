@extends ('layouts.app')

@section('content')

<h1><u>Found Lost Items</u></h1>
<table class="table table-striped">
    @if(count($posts) >= 1)
        @foreach($posts as $post)
            <div class= "card">
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                        <br>
                        <img style="width:110px" src="/storage/c_image/{{$post->c_image}}">
                        <br>
                        <br>
                    </div>

                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                        <small>Written on {{$post->created_at}}</small>
                        @if(!Auth::guest())
                            @if(Auth::user()->id != $post->user_id)
                                <div class = "float-right"><a href="{{action('RequestController@create', $post->id)}}" class="btn btn-outline-danger">Request</a></div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
        
    @else 
        <p>No posts found</p>
    @endif
@endsection