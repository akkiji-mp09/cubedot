<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        //return view('post');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $data['tag_list'] = Tag::where('status', 1)->get();

        return view('post', $data);
    
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
            'title' => 'required|unique:posts,title',
            'description' => 'required',
            'fimage' => 'required',
            'tag_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('post')
                        ->withErrors($validator)
                        ->withInput();
        }

        $image = '';
        if (!empty($request->has('fimage'))) {
            
                $image = time().".".$request->file('fimage')->getClientOriginalExtension();
                $chk = $request->file('fimage')->move(public_path('uploads'), $image);
            
        }

        $post = Post::firstOrNew(['id'=> $request->user_id]);
        $post->title = $input['title'];
        $post->slug = \Str::of($input['title'])->slug('-');
        $post->description = $input['description'];
        $post->tag_id = implode(',', $input['tag_id']);
        $post->featured_image = $image;
        
        $post->save();

        

       return redirect('post');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
   
   public function display(){

            $posts = Post::all();
            return view('welcome')->with('posts', $posts);        
   } 
}
