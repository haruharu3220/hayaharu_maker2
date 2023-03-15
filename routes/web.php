<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//ツイートコントローラーを使えるようにする
use App\Http\Controllers\TweetController;
use App\Http\Controllers\TeamController;


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
//ログインしていないユーザはアプリケーションにアクセスできないようにする
//Tweet用の一括ルーティング
Route::middleware('auth')->group(function () {
    Route::resource('tweet', TweetController::class);
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
