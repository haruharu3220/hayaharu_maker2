<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//コントローラーを使えるようにする
use App\Http\Controllers\TweetController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\SearchController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------

*/
//ログインしていないユーザはアプリケーションにアクセスできないようにする
//Tweet用の一括ルーティング
Route::middleware('auth')->group(function () {
    Route::get('/tweet/search/input', [SearchController::class, 'create'])->name('search.input');
    Route::get('/tweet/search/result', [SearchController::class, 'index'])->name('search.result');

    
    Route::resource('tweet', TweetController::class);
    Route::post('tweet/{tweet}/favorites', [FavoriteController::class, 'store'])->name('favorites');
    Route::post('tweet/{tweet}/unfavorites', [FavoriteController::class, 'destroy'])->name('unfavorites');
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/team/create', [TeamController::class, 'create'])->name('team.create');
     Route::post('/team/create', [TeamController::class, 'register'])->name('team.create');
});


require __DIR__.'/auth.php';
