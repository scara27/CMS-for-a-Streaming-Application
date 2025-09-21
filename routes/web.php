<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentController;

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('content.login');
});

Route::get('/content/movie', [ContentController::class, 'index'])->name('content.index.movie');
Route::get('/content/show', [ContentController::class, 'index'])->name('content.index.tvshow');
Route::get('/content/live', [ContentController::class, 'index'])->name('content.index.live');
Route::get('/content/content_list', [ContentController::class, 'index'])->name('content.index.content_list');

Route::get('/content', function () {
    return view('content.content');
})->name('content.index');

// Routes for creating content
Route::get('/content/movies/create', [ContentController::class, 'createMovie'])->name('content.create.movie');
Route::get('/content/tvshows/create', [ContentController::class, 'createTVShow'])->name('content.create.tvshow');
Route::get('/content/live/create', [ContentController::class, 'createLive'])->name('content.create.live');

// Routes for storing the new content
Route::post('/content/movies', [ContentController::class, 'storeMovie'])->name('content.store.movie');
Route::post('/content/tvshows', [ContentController::class, 'storeTVShow'])->name('content.store.tvshow');
Route::post('/content/live', [ContentController::class, 'storeLive'])->name('content.store.live');

Route::get('/content/create', [ContentController::class, 'createContent'])->name('content.create.content');
Route::post('/content/store', [ContentController::class, 'storeContent'])->name('content.store.content');

// Routes for editing and deleting movies
Route::get('/content/movies/edit/{id}', [ContentController::class, 'editMovie'])->name('content.edit.movie');
Route::put('/content/movies/{id}', [ContentController::class, 'updateMovie'])->name('content.update.movie');
Route::delete('/content/movies/{id}', [ContentController::class, 'deleteMovie'])->name('content.delete.movie');

// Routes for editing and deleting TV Shows
Route::get('/content/tvshows/edit/{id}', [ContentController::class, 'editTVShow'])->name('content.edit.tvshow');
Route::put('/content/tvshows/{id}', [ContentController::class, 'updateTVShow'])->name('content.update.tvshow');
Route::delete('/content/tvshows/{id}', [ContentController::class, 'deleteTVShow'])->name('content.delete.tvshow');

// Routes for editing and deleting Live content
Route::get('/content/live/edit/{id}', [ContentController::class, 'editLive'])->name('content.edit.live');
Route::put('/content/live/{id}', [ContentController::class, 'updateLive'])->name('content.update.live');
Route::delete('/content/live/{id}', [ContentController::class, 'deleteLive'])->name('content.delete.live');

// Routes for deleting Content
Route::delete('/content/delete/{id}', [ContentController::class, 'deleteContent'])->name('content.delete');

// routes/web.php
Route::get('/omdb/details/{imdbId}', [ContentController::class, 'getDetailsOmdb']);


Route::get('login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])
    ->name('login');
Route::post('login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);
Route::post('logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    Route::get('/content/movie', [ContentController::class, 'index'])->name('content.index.movie');
    Route::get('/content/show', [ContentController::class, 'index'])->name('content.index.tvshow');
    Route::get('/content/live', [ContentController::class, 'index'])->name('content.index.live');
    Route::get('/content/content_list', [ContentController::class, 'index'])->name('content.index.content_list');

    Route::get('/content', function () {
        return view('content.content'); // Reference to content/content.blade.php
    })->name('content.index');

    // Routes for creating content
    Route::get('/content/movies/create', [ContentController::class, 'createMovie'])->name('content.create.movie');
    Route::get('/content/tvshows/create', [ContentController::class, 'createTVShow'])->name('content.create.tvshow');
    Route::get('/content/live/create', [ContentController::class, 'createLive'])->name('content.create.live');

    // Routes for storing the new content
    Route::post('/content/movies', [ContentController::class, 'storeMovie'])->name('content.store.movie');
    Route::post('/content/tvshows', [ContentController::class, 'storeTVShow'])->name('content.store.tvshow');
    Route::post('/content/live', [ContentController::class, 'storeLive'])->name('content.store.live');


    // Routes for editing and deleting movies
    Route::get('/content/movies/edit/{id}', [ContentController::class, 'editMovie'])->name('content.edit.movie');
    Route::put('/content/movies/{id}', [ContentController::class, 'updateMovie'])->name('content.update.movie');
    Route::delete('/content/movies/{id}', [ContentController::class, 'deleteMovie'])->name('content.delete.movie');

    // Routes for editing and deleting TV Shows
    Route::get('/content/tvshows/edit/{id}', [ContentController::class, 'editTVShow'])->name('content.edit.tvshow');
    Route::put('/content/tvshows/{id}', [ContentController::class, 'updateTVShow'])->name('content.update.tvshow');
    Route::delete('/content/tvshows/{id}', [ContentController::class, 'deleteTVShow'])->name('content.delete.tvshow');

    // Routes for editing and deleting Live content
    Route::get('/content/live/edit/{id}', [ContentController::class, 'editLive'])->name('content.edit.live');
    Route::put('/content/live/{id}', [ContentController::class, 'updateLive'])->name('content.update.live');
    Route::delete('/content/live/{id}', [ContentController::class, 'deleteLive'])->name('content.delete.live');

    // routes/web.php
    Route::get('/omdb/details/{imdbId}', [ContentController::class, 'getDetailsOmdb']);


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
