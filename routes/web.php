<?php

// menghubungkan ke model post.php (klik kanan - import all classes)

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardPostController;

Route::get('/', function () {
    return view('home', [
        "title" => "Home",
        "active" => 'home'
    ]);
});

Route::get('/about', function () {
    return view('about', [
        "name" => "Erlangga Kurniawan",
        "email" => "erlanggakur@gmail.com",
        "img" => "angga.jpg",
        "title" => "About",
        "active" => 'about'

    ]);
});

// Hubungkan dengan Controllers-PostController | Method Index
Route::get('/posts', [PostController::class, 'index']);
// post ditangkap oleh PostController & slug ditangkap dari posts.blade
Route::get('/posts/{post:slug}', [PostController::class, 'show']);

Route::get('/categories', function(){
    return view ('categories', [
        'title' => 'Post Categories',
        'active' => 'categories',
        'categories' => Category::all()
    ]);
});

Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);


// jika belum login, maka akses ke dashboard tidak bisa
// middleware berguna ketika user telah login
Route::get('/register', [RegisterController::class, 'index'])->name('login')->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function() {
    return view('dashboard/index');
} )->middleware('auth');

Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])
    ->middleware('auth') ;

Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

// Route::get('/categories/{category:slug}', function(Category $category){
//     return view ('posts', [
//         'title' => "Post By Category : $category->name",
//         'active' => 'categories',
//         'posts' => $category->posts->load('author', 'category'),
//     ]);
// });

// Route::get('/authors/{author:username}', function(User $author){
//     return view ('posts', [
//         'title' => "Post By Author : $author->name",
//         'active' => 'posts',
//         // LAZY EAGER LOADING MENGATASI N+1 PROBLEM, WAJIB DOWNLOAD 'composer require itsgoingd/clockwork'
//         'posts' => $author->posts->load('category', 'author'),
//     ]);
// });


