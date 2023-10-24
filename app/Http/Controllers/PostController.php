<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;

class PostController extends Controller
{
    // Method index
    public function index()
    {           
        $title = '';
        if(request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = ' In : ' . $category->name; 
        }

        if(request('author')) {
            $author = User::firstWhere('username', request('author'));
            $title = ' By : ' . $author->name;
        }


        return view('posts',[
            "title" => "All Posts" . $title,
            "active" => "posts",

            // "posts" => Post::all()
            // with untuk mengatasi n+1 problem dan mengatasi query yang berlebihan (gak ngelag) -EAGER LOADING

            // wajib download 'composer require itsgoingd/clockwork'
            // "posts" => Post::latest()->get()

            // mengambil filter dari Post.php
            // paginate untuk mengambil data secukupnya lalu dibatasi dengan 7
            // withQueryString untuk tidak pindah ke category yang lain
            "posts" => Post::latest()->filter(request(['search', 'category', 'author']))
            ->paginate(7)->withQueryString()
        ]);
    }

    // Method show
    // Post $post diambil dari web.php
    public function show(Post $post)
    {
        return view('post',[
            "title" => "Single Post",
            "active" => "posts",
            "post" => $post
        ]);
    }

}