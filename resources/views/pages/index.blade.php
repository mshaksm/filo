@extends('layouts.app')
@section('content')

<div class="jumbotron pt-4">
    
        <h1><u>Welcome To Filo</u></h1>
        <br/>

        <p>FILO! Short for Find the Lost</p>
        <p>This application is used to help those who have lost items</p>
        <p>Found a lost item? Login to create a post and help those retrieve back lost items</p>
        
        <br>
        <br>
        @if(Auth::guest())
        <p><b>Please login for full user experience</b></p>
<p><a class="btn btn-primary btn-lg" href="{{url('login')}}" role="button">Login</a> <a class="btn btn-success btn-lg" href="{{ url('register') }}" role="button">Register</a></p>

          @elseif(Auth::user())
            <h4><b>Hurray! {{ Auth::user()->name }} You've Logged in!</b></h4>
          
            <br>
            <p><a class="btn btn-primary btn-lg" href="{{ url('dashboard') }}" role="button">Go To Dashboard</a>
          
        @endif


    </div>
@endsection
