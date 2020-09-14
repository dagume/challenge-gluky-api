<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->isJson()) {
            return response()->json(['data' => Post::all()], 200);
        }
        return response()->json(['error' => 'unauthorized'], 401);

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'description'     => 'required|string',
        ]);
        $user = DB::table('users')
        ->select('id','name', 'email', 'created_at', 'updated_at')
        ->where('id', auth()->user()->id)->first();
        
        if ($request->file('thing'))
        {
            $path = $request->file('thing')->store('gluky-folder','s3');
            Storage::disk('s3')->setVisibility($path, 'public');
            $request['image'] = Storage::disk('s3')->url($path);
        }
        $request['user_id'] = auth()->user()->id;
        $request['post_date'] = now();
        $post = Post::create($request->all());
        return response()->json(['data' => ['post' =>$post,'owner'=>$user]], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
