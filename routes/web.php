<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => ['auth']], function () {

    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
    // ajax
    Route::get('/posts/{id}/view', [PostController::class, 'view'])->name('posts.view');
    // restore
    Route::post('/posts/{post}/restore', [PostController::class, "restore"])->name("posts.restore");
});
Auth::routes();

//comments
Route::post('/comments', [CommentController::class, "store"])->name("comments.store");
Route::delete('/comments/{id}', [CommentController::class, "destroy"])->name("comments.destroy");

//liveWire
// Route::view('posts/${id}', 'livewire.comments')->name('comments');

//User Profile


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
