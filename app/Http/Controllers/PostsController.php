<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('posts.index')->with('posts', $posts);
    }

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*$this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);*/
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'c_image' => 'image|nullable|max:1999'
        ]);
        //handle upload from file
        if($request->hasFile('c_image')){
            // Get the filename with extension
            $fileNameExtension = $request->file('c_image')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameExtension, PATHINFO_FILENAME);
            // Get just extension
            $extension = $request->file('c_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('c_image')->storeAs('public/c_image', $fileNameToStore);


        }else{
            $fileNameToStore = 'noimage.jpg';
        }

        // create post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->c_image = $fileNameToStore;
        $post->save();

       return redirect()->route('posts')->with('success', 'Post Created');

     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

                // Check the user matches otherwise display error and redirect to posts page
                if(auth()->user()->id !==$post->user_id){
                    return redirect('/posts')->with('error', 'Access denied');
                }

        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'c_image' => 'image|nullable|max:1999'
        ]);

        //handle upload from file
        if($request->hasFile('c_image')){
            // Get the filename with extension
            $fileNameExtension = $request->file('c_image')->getClientOriginalName();
            // Get only file name
            $fileName = pathinfo($fileNameExtension, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('c_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('c_image')->storeAs('public/c_image', $fileNameToStore);


        }            

        

        // create post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('c_image')){
            $post->c_image = $fileNameToStore;
        }
        $post->save();

       return redirect('/posts')->with('success', 'Post Updated');

     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        // Check the user matches otherwise display error and redirect to posts page
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error', 'Access denied');
        }

        if($post->cover_image != 'noimage.jpg'){
            // delete
            Storage::delete('public/c_image/'.$post->c_image);



        }

        

        $post->delete();
        return redirect('/posts')->with('success', 'Post Removed');

    }
}
