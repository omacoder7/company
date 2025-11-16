<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\AboutController;
use App\Http\Controllers\Web\ServiceController;
use App\Http\Controllers\Web\CaseStudyController;
use App\Http\Controllers\Web\DeveloperController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PageContentController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\CaseStudyController as AdminCaseStudyController;
use App\Http\Controllers\Admin\DeveloperTaskController;

// Authentication Routes
Route::middleware('guest')->group(function () {
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/services', [ServiceController::class, 'index'])->name('services');
Route::get('/cases', [CaseStudyController::class, 'index'])->name('cases');
Route::get('/cases/{id}', [CaseStudyController::class, 'show'])->name('cases.show');
Route::get('/developers', [DeveloperController::class, 'index'])->name('developers');
Route::post('/developers/apply', [DeveloperController::class, 'apply'])->name('developers.apply');
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Page Content
    Route::get('/pages', [PageContentController::class, 'index'])->name('pages');
    Route::post('/pages', [PageContentController::class, 'update'])->name('pages.update');
    
    // Services
    Route::resource('services', AdminServiceController::class)->except(['show']);
    Route::get('/services/{id}', [AdminServiceController::class, 'show'])->name('services.show');
    
    // Case Studies
    Route::resource('cases', AdminCaseStudyController::class)->except(['show']);
    Route::get('/cases/{id}', [AdminCaseStudyController::class, 'show'])->name('cases.show');
    
    // Developer Tasks
    Route::resource('developer-tasks', DeveloperTaskController::class)->except(['show']);
    Route::get('/developer-tasks/{id}', [DeveloperTaskController::class, 'show'])->name('developer-tasks.show');
});

