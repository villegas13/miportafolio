<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$posts = Post::all();
        //return view('dashboard.posts.index', compact('posts'));
        return "dddddddddd";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Aquí puedes validar y crear un nuevo post
        Post::create(
            [
            'title' => $request->all()['title'],
            'slug' => $request->all()['slug'],
            'content' => $request->all()['content'],
            'category_id' => $request->all()['category_id'],
            'descripcion' => $request->all()['descripcion'],
            'posted' => $request->all()['posted'],
            'image' => $request->all()['image'],
           ]
        );

        dd(request()->get('title')); // Debugging line to check the request data
    }

    
}