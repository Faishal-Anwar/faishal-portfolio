<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\StackController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;

// Public Routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'storeContactForm'])->name('contact.store');
Route::get('/sitemap.xml', [PageController::class, 'sitemap'])->name('sitemap');


// Public Resource Routes
Route::resource('about', AboutController::class)->only(['index', 'show']);
Route::resource('stack', StackController::class)->only(['index', 'show']);
Route::resource('projects', ProjectController::class)->only(['index', 'show']);

// Authenticated (Admin) Resource Routes
Route::middleware('auth')->group(function () {
    Route::resource('about', AboutController::class)->except(['index', 'show']);
    Route::resource('stack', StackController::class)->except(['index', 'show']);
    Route::resource('projects', ProjectController::class)->except(['index', 'show']);

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Authentication Routes
Route::get('login', [LoginController::class, 'create'])->name('login');
Route::post('login', [LoginController::class, 'store']);
Route::post('logout', [LoginController::class, 'destroy'])->name('logout');