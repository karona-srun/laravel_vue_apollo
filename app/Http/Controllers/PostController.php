<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->get();
        return response()->json([
            "success" => true,
            "message" => "Posts",
            "posts" => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required',
        ]);
   
        if($validator->fails()){
            return response()->json([
                "success" => false,
                "message" => "Validation Error.",
                "data" => $validator->errors()
            ]);     
        }
        $post = Post::create($input);
        return response()->json([
            "success" => true,
            "message" => "Post created successfully.",
            "post" => $post
        ]);
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
        if (is_null($post)) {
			return response()->json([
                "success" => false,
                "message" => "Post not found."
            ]);
		}
        return response()->json([
            "success" => true,
            "message" => "Post created successfully.",
            "post" => $post
        ]);
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
        if (is_null($post)) {
			return response()->json([
                "success" => false,
                "message" => "Post not found."
            ]);
		}
        return response()->json([
            "success" => true,
            "message" => "Post edited successfully.",
            "post" => $post
        ]);
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
        $input = $request->all();
		$validator = Validator::make($input, [
			'title' => 'required',
            'description' => 'required',
		]);
		
		if($validator->fails()){
            return response()->json([
                "success" => false,
                "message" => "Validation Error.",
                "data" => $validator->errors()
            ]);     
        }

        $post = Post::find($id);
        if (is_null($post)) {
			return response()->json([
                "success" => false,
                "message" => "Post not found."
            ]);
		}
		$post->title = $input['title'];
		$post->description = $input['description'];
		$post->status = $input['status'];
		$post->save();
		
		return response()->json([
			"success" => true,
			"message" => "Post updated successfully.",
			"post" => $post
		]);
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
        if (is_null($post)) {
			return response()->json([
                "success" => false,
                "message" => "Post not found."
            ]);
		}
        $post->delete();
        return response()->json([
            "success" => true,
            "message" => "Post deleted successfully.",
            "post" => $post
        ]);
    }
}
