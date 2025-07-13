<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    // Muestra el formulario para crear un nuevo post
     public function index()
    {
         return 'welcome';
    }
    public function create()
    {
        return view('posts.create');
    }
}