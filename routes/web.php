<?php

use App\Services\Newsletter;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Middleware\MustBeAdministrator;

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('/posts/{post:slug}', [PostController::class, 'show']);
Route::post('/posts/{post:slug}/comments', [PostCommentsController::class, 'store']);

Route::post('newsletter', NewsletterController::class);

Route::get('register',[RegisterController::class, 'create'])->middleware('guest');

Route::post('register',[RegisterController::class, 'store'])->middleware('guest');

Route::get('login',[SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('login',[SessionsController::class, 'store'])->middleware('guest');

Route::post('logout',[SessionsController::class, 'destroy'])->middleware('auth');

// Route::get('admin/post/create',[PostController::class, 'create']);
Route::get('admin/post/create',[PostController::class, 'create'])->middleware((MustBeAdministrator::class));
Route::post('admin/posts',[PostController::class, 'store'])->middleware((MustBeAdministrator::class));


// ->middleware((MustBeAdministrator::class))
