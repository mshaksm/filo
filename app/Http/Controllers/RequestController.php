<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Requests;
use App\Post;
use Auth;

class RequestController extends Controller
{
    public function __construct(){
        $this->middleware('auth',[
            'except' => ['index', 'show']
        ]);
    }

    //Showing all the requests made by the users
    public function index(){

        //Only the admin should be allowed to access the list of requests made by other users
        if(Auth::user()->role != 1){
            return view('/requests')->with('error', 'Unauthorized Page');
        }

        $requests = Requests::all();
        return view('requests.index')->with('requests', $requests);
    }

    //Allowing the user to create a request
    public function create($id){

        $posts = Post::find($id);
        return view('requests.create')->with('posts', $posts);
    }

    //Storing a request into the database
    public function store(Request $request){
        //checks to see if the reason has been provided
        $this->validate($request, [
            'reason' => 'required'
        ]);

        //Creating a request
        $requests = new Requests();
        $requests->reason = $request->input('reason');
        $requests->status = $request->input('status');
        $requests->user_id = auth()->user()->id;
        $requests->post_id = $request->input('id');
        //sends the request to the database
        $requests->save();

        return redirect()->route('posts')->with('success', 'The admin will be reviewing your request shortly');//changed
    }

    //Displays the request based on the id passed
    public function show($id){
        $requests = Requests::find($id);
        return view('requests.show')->with('requests', $requests);
    }

    //Deletes the request from the database
    public function destroy($id){
        $requests = Requests::find($id);
        $requests->delete();
        return redirect('/requests');
    }

    public function approve($id){
        $requests = Requests::find($id);
        $requests->status = 'Accepted';
        $requests->save();

        return redirect('/requests')->with('success', 'Response successfully made');
    }

    public function refuse($id){
        $requests = Requests::find($id);
        $requests->status = 'Refused';
        $requests->save();

        return redirect()->route('requests')->with('success', 'Response successfully made');
    }
}
