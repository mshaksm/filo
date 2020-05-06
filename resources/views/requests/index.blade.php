<!-- shows the page for the list of requests -->
@extends('layouts.app')
@section('content')
<h1>Requests</h1>
<br>
<div class="shadow-lg p-3 mb-4 bg-white rounded">
        <table class="table">
            <br>
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Title</th>
                    <th scope="col">Request Decision</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            @if(count($requests) > 0)
            <!-- goes through each request displaying it -->
                @foreach($requests as $request)
                    <tbody>
                        <tr>
                            <td>
                                <p>{{$request->user->name}}</p>
                            </td>
                            <td>
                                <a href="#">{{$request->post->title}}</a>
                            </td>
                            <td>
                                <!-- clicking this approves the request and request id is needed so that it can be deleted after approval -->
                                <a href="{{action('RequestController@approve', $request->id)}}" class="btn btn-primary">Approve</a>
                                <!-- clicking this disapproves the request and request id is needed so that it can be deleted after disapproval -->
                                <a href="{{action('RequestController@refuse', $request->id)}}" class="btn btn-danger">Decline</a>
                            </td>
                            <td>
                            <p>{{$request->status}}</p>
                            </td>
                        </tr>
                    </tbody>
                @endforeach
        </table>
    </div>
    @else
        <p>No Requests to show!</p>
    @endif
@endsection