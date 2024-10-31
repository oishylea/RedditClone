<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController; // Import your CourseController here
use App\Http\Controllers\Backend\CommunityController;
use App\Http\Controllers\Backend\CommunityPostController;
use App\Http\Controllers\Frontend\FrontendCommunityController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\PostCommentController;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

// Route to test database connection
Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return 'Database connection is successful!';
    } catch (\Exception $e) {
        return 'Database connection failed: ' . $e->getMessage();
    }
});

// Homepage Route
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get( '/r/{slug}',[FrontendCommunityController::class,'show'])->name('frontend.communities.show');
Route::get( '/r/{community_slug}/posts/{post:slug}',[PostController::class,'show'])->name('frontend.communities.posts.show');
Route::post( '/r/{community_slug}/posts/{post:slug}/comments',[PostCommentController::class,'store'])->name('frontend.posts.comments');

Route::get('/r/{community}/posts/{post}/edit', [CommunityPostController::class, 'edit'])->name('communities.posts.edit');

// Profile Management Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Course Management Routes
Route::middleware('auth')->group(function () {
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::patch('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
});
Route::group(['middleware' => ['auth', 'verified']], function () {
    
    // Route::get('/dashboard', function () {
    //     return Inertia::render('Dashboard');
    // })->name('dashboard');

    Route::resource('/communities', CommunityController::class);
    Route::resource('/communities.posts', CommunityPostController::class);

    Route::post('/communities/{community}/posts', [CommunityPostController::class, 'store'])
    ->name('communities.posts.store');
});
Route::get('/r/{community}', [CommunityController::class, 'show'])->name('frontend.communities.show');



// Load authentication routes
require __DIR__.'/auth.php';