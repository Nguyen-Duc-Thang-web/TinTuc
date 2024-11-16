<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuthenController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdvertisementController;
// use App\Http\Controllers\AuthenController;
// use App\Http\Controllers\CommentController;
// use App\Http\Controllers\MemberController;
use App\Http\Controllers\Search2Controller;
use App\Http\Controllers\Admin\DashboardController;
// a
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('home/profile', [HomeController::class, 'profile'])->name('home/profile');
Route::post('home/update', [HomeController::class, 'updatePassword'])->name('password.update');
Route::post('home/profile', [HomeController::class, 'update'])->name('profile.update');

Route::prefix('admin')->as('admin.')->group(function () {
    Route::get('register', [AuthenController::class, 'formDangKy'])->name('register');
    Route::post('register', [AuthenController::class, 'dangKy']);

    Route::get('login', [AuthenController::class, 'formDangNhap'])->name('login');
    Route::post('login', [AuthenController::class, 'dangNhap']);

    Route::post('logout', [AuthenController::class, 'dangXuat'])->name('logout');
});

Route::controller(AuthenController::class)->group(function () {

    Route::get('auth/twitter', 'redirectToTwitter')->name('auth.twitter');

    Route::get('auth/twitter/callback', 'handleTwitterCallback');
});
Route::controller(AuthenController::class)->group(function () {

    Route::get('auth/facebook', 'redirectToFacebook')->name('auth.facebook');

    Route::get('auth/facebook/callback', 'handleFacebookCallback');
});
Route::controller(AuthenController::class)->group(function () {

    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');

    Route::get('auth/google/callback', 'handleGoogleCallback');
});

// Client
Route::group([], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('post/{slug}', [HomeController::class, 'postDetail'])->name('post-detail');
    Route::get('category/{slug}/posts', [HomeController::class, 'findPostByCategory'])->name('category.posts');
    Route::get('faq', [HomeController::class, 'faqs'])->name('faq');
    Route::get('contact', [HomeController::class, 'contactPage'])->name('contact');
    Route::post('contact', [HomeController::class, 'submitContact'])->name('contact.store');
    Route::get('profile', [MemberController::class, 'showProfile'])->name('profile');
    Route::post('change-password', [MemberController::class, 'changePassword'])->name('change-password');
    Route::put('update-profile', [MemberController::class, 'updateProfile'])->name('update-profile');
    Route::get('/search', [Search2Controller::class, 'search'])->name('search');
    Route::get('articles/{id}', [HomeController::class, 'showNotifications'])->name('articles.show');
    Route::get('notifications', [HomeController::class, 'getNotifications']);
});

// Admin
Route::group(['mdddleware' => ['auth', 'checkadmin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('/search', [SearchController::class, 'search'])->name('search');

    Route::get('dashboard/{timeframe?}', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('categories')->as('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('/{slug}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/{slug}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{slug}', [CategoryController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('advertisements')->as('advertisements.')->group(function () {
        Route::get('/', [AdvertisementController::class, 'index'])->name('index');
        Route::get('/create', [AdvertisementController::class, 'create'])->name('create');
        Route::post('/', [AdvertisementController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdvertisementController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdvertisementController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdvertisementController::class, 'destroy'])->name('destroy');
        Route::get('/trashed', [AdvertisementController::class, 'trashed'])->name('trashed');
        Route::patch('/{id}/restore', [AdvertisementController::class, 'restore'])->name('restore');
        Route::delete('/{id}/force-delete', [AdvertisementController::class, 'forceDelete'])->name('force-delete');
    });

    Route::prefix('contacts')->as('contacts.')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('index');
        Route::get('/{id}', [ContactController::class, 'show'])->name('show');
        Route::delete('/{id}', [ContactController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('faqs')->as('faqs.')->group(function () {
        Route::get('/', [FaqController::class, 'index'])->name('index');
        Route::get('/create', [FaqController::class, 'create'])->name('create');
        Route::post('/', [FaqController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [FaqController::class, 'edit'])->name('edit');
        Route::put('/{id}', [FaqController::class, 'update'])->name('update');
        Route::delete('/{id}', [FaqController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('users')->as('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('posts')->as('posts.')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/', [PostController::class, 'store'])->name('store');
        Route::post('upload', [PostController::class, 'upload'])->name('upload');
        Route::get('/{id}/edit', [PostController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PostController::class, 'update'])->name('update');
        Route::delete('/{id}', [PostController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('comments')->as('comments.')->group(function () {
        Route::get('/', [CommentController::class, 'index'])->name('index');
        Route::get('/create', [CommentController::class, 'create'])->name('create');
        Route::post('/', [CommentController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [CommentController::class, 'edit'])->name('edit');
        Route::put('/{id}', [CommentController::class, 'update'])->name('update');
        Route::delete('/{id}', [CommentController::class, 'destroy'])->name('destroy');
    });
});

Route::resource('roles', RoleController::class);
Route::post('roles/{id}/restore', [RoleController::class, 'restore'])
    ->name('roles.restore');
Route::delete('roles/{id}/force-delete', [RoleController::class, 'forceDelete'])
    ->name('roles.forceDelete');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.chitiet');
Route::post('post/{slug}/comment', [CommentController::class, 'store'])->name('post.comment');
// Route::post('post/{post}/comment', [HomeController::class, 'addComment'])->name('post.comment');