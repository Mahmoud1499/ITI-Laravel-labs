<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CommentController;






use App\Models\User;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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




//Socialite GitHub

Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('githubLogin');

Route::get('/auth/callback', function () {

    $githubUser = Socialite::driver('github')->stateless()->user();
    // dd($githubUser);

    $user = User::updateOrCreate([
        'github_id' => $githubUser->id,
        'password' => 'githubApi',

    ], [
        'name' => $githubUser->name,
        'email' => $githubUser->email,
        'github_token' => $githubUser->token,
        'github_refresh_token' => $githubUser->refreshToken,
    ]);

    Auth::login($user);
    // to_route('posts.index');
    // dd($user);
    // $user->token
});

//Gmail
Route::get('redirect/{driver}', [LoginController::class, "redirectToProvider"])
    ->name('login.provider')
    ->where('driver', implode('|', config('auth.socialite.drivers')));
Route::get('{driver}/callback', [LoginController::class, "handleProviderCallback"])
    ->name('login.callback')
    ->where('driver', implode('|', config('auth.socialite.drivers')));
