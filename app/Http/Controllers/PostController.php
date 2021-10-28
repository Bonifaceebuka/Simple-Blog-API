<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::all();
        return view('posts.index',['posts'=>$post]);
    }

    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('posts.create',['categories'=>$categories]);
    }

    /**
     * Store a newly created post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'required',
            'category' => 'required|int',
            'poster' => 'image|mimes:jpeg,jpg,png|max:5120',
        ]);
        
        $poster = $request->file('poster');
        $path = 'posters/';
        $postername = 'poster.png';
        if(isset($poster) && $poster !== null){
            $postername = uniqid().'.'.$poster->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('posters')){
                Storage::disk('public')->makeDirectory('posters');
            }
            $request->file('poster')->storeAs($path, $postername, 'public');
            $postername = $postername;
        }
        $post = new Post([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category,
            'poster' => $postername,
            'admin_id' => 3,
        ]);
       
        if($post->save()) 
        {
            $success = 'Post created successfully';
            return redirect()->back()->with('success-message', $success);
        } 
        else{
            $error = 'Unable to create a new post';
            return redirect()->back()->with('error-message', $error);
        }
    }

    /**
     * Display the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrfail($id);
        $categories = Category::get();
        return view('posts.edit',['categories'=>$categories,'post'=>$post]);
    }

    /**
     * Update the specified post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'required',
            'category' => 'required|int',
            'poster' => 'image|mimes:jpeg,jpg,png|max:5120',
        ]);
        
        $poster = $request->file('poster');
        $post = Post::findOrfail($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->category_id = $request->category;
        $post->admin_id = 1;
        $path = 'posters/';
        if(isset($poster) && $poster !== null){
            ///Remove the old image
            if(Storage::disk('public')->exists($path.$post->poster)){
                Storage::disk('public')->delete($path.$post->poster);
            }
            ///Remove the old image ends here
            $postername = uniqid().'.'.$poster->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('posters')){
                Storage::disk('public')->makeDirectory('posters');
            }
            $request->file('poster')->storeAs($path, $postername, 'public');
            $post->poster = $postername;
        }
            
        if($post->save()) 
        {
            $success = 'Post updated successfully';
            return redirect()->back()->with('success-message', $success);
        } 
        else{
            $error = 'Unable to save the changes';
            return redirect()->back()->with('error-message', $error);
        }
    }

    /**
     * Remove the specified post from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrfail($id);
        $path = 'posters/';
        if(Storage::disk('public')->exists($path.$post->poster)){
            Storage::disk('public')->delete($path.$post->poster);
        }
        if($post->delete())
        {
            $success = 'Post removed successfully';
            return redirect()->back()->with('success-message', $success);
        }
        else{
            $error = 'Unable to remove the seletced record';
            return redirect()->back()->with('error-message', $error);
        }
    }
}
