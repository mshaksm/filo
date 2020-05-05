<!-- form to creating the request -->
@extends('layouts.app')

@section('content')
<h1>Submit a request</h1>

<div class="p-2">
    <h5>Fill the details below</h5>
</div>

<!-- stores the credentials into requests table -->

<form method="POST" action="{{action('RequestController@store')}}">
    @csrf
    <div class="form-group">
        <label for="reason">Reason of the request</label>
        <textarea id="summary-ckeditor" class="form-control" name="reason" cols="30" rows="10" placeholder="Enter Description Here!"></textarea>
    </div>
    <input type="hidden" name="status" value="Pending">
    <!-- required as the item id for the request this is how the admin gets the post itself from the request -->
    <input type="hidden" name="id" value="{{$posts->id}}">
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection