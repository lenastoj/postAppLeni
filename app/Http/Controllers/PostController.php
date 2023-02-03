<?php

namespace App\Http\Controllers;

use App\Mail\deleteMail;
use App\Mail\postMail;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5|max:100|string',
            'body' => 'required|min:5|max:5000|string',
        ]);
        $post = new Post();
        $post->body = $request->body;
        $post->title = $request->title;
        $post->user()->associate(Auth::user());
        $post->save();

        $email = Auth::user()->email;
        $mailData = $request->only('title');
        Mail::to($email)->send(new postMail($mailData));


        return redirect('create-post');

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
        return view('post', compact('post'));
    }

    public function myPosts() {
        $posts = Post::where('user_id', Auth::user()->id)->get();
        return view('myposts', compact('posts'));
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
        //
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
        
        if($post) {

            $email = $post->user->email;
            // $email = Auth::user()->email;
            $mailData = $post->only('title');
            Mail::to($email)->send(new deleteMail($mailData));

            $post->delete();
        }
        return redirect('myposts');
    }
}
