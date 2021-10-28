<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Display a listing of the posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->query('filter')){
            $filter = $request->query('filter');
            $posts = Post::where('title','LIKE' , '%'.$filter.'%')
            ->orderBy('title','ASC')->paginate(10);
        }
        else{
            $posts = Post::paginate(10);
        }
        return view('posts.index',['posts'=>$posts]);
    }
}
