<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\AboutController;
use App\Http\Controllers\Web\ShopController;
use App\Http\Controllers\Web\PortfolioController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\ReviewController;
use App\Http\Controllers\Web\UserController as UsersController;
use App\Http\Controllers\Web\SearchController;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PlantController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ToolController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/',                     [HomeController::class,'index']);
Route::get('/home',                 [HomeController::class,'home'])->name('home');
Route::get('/about',                [AboutController::class,'index'])->name('about');
Route::get('/shop-plants',          [ShopController::class,'index'])->name('shop.plants');
Route::get('/shop-tools',           [ShopController::class,'tools'])->name('shop.tools');
Route::get('/plant-details/{id}',   [ShopController::class,'plantDetails'])->name('plantDetails');
Route::get('/tool-details/{id}',    [ShopController::class,'toolDetails'])->name('toolDetails');
Route::get('/portfolio',            [PortfolioController::class,'index'])->name('portfolio');
Route::get('/contact',              [ContactController::class,'index'])->name('contact');
Route::post('/post-contact',        [ContactController::class,'postContact'])->name('postContact');
Route::post('/plant-reviews',       [ReviewController::class,'plantReviews'])->name('plantReviews');
Route::post('/tool-reviews',        [ReviewController::class,'toolReviews'])->name('toolReviews');
Route::get('/search',               [SearchController::class,'search'])->name('search');

// Route::get('/company',              [HomeController::class,'getCompany']);

Route::middleware('cart')->group(function () {
    Route::get('/cart',                         [ShopController::class,'cart'])->name('cart');
    Route::post('/plant-to-cart',               [CartController::class,'plantToCart'])->name('plantToCart');
    Route::post('/tool-to-cart',                [CartController::class,'toolToCart'])->name('toolToCart');
    Route::get('/delete-cart/{id}',             [CartController::class,'deleteCart'])->name('deleteCart');
});

Route::middleware('user-profile')->group(function () {
    Route::get('/user-profile/{id}',            [UsersController::class,'userProfile'])->name('userProfile');
});

Route::middleware('profile')->group(function () {
    Route::post('/edit-profile',                [UsersController::class,'editProfile'])->name('editProfile');
});

Route::prefix('admin')->group(function () {

    Route::middleware('admin')->group(function () {
        Route::get('/dashboard',                [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
        Route::get('/users',                    [UserController::class, 'index'])->name('users');
        Route::get('/delete-users/{id}',             [UserController::class, 'deleteUsers'])->name('deleteUsers');
        Route::get('/plants',                   [PlantController::class, 'index'])->name('plants');
        Route::get('/adding-plants',            [PlantController::class, 'addingPlants'])->name('addingPlants');
        Route::post('/add-plants',              [PlantController::class, 'addPlants'])->name('addPlants');
        Route::get('/delete-plants/{id}',       [PlantController::class, 'deletePlants'])->name('deletePlants');
        Route::get('/categories',               [CategoryController::class, 'index'])->name('categories');
        Route::get('/adding-categories',        [CategoryController::class, 'addingCategories'])->name('addingCategories');
        Route::post('/add-categories',          [CategoryController::class, 'addCategories'])->name('addCategories');
        Route::get('/edit-page-category/{id}',  [CategoryController::class, 'editPageCategory'])->name('editPageCategory');
        Route::post('/edit-category',           [CategoryController::class, 'editCategories'])->name('editCategories');
        Route::get('/orders',                   [OrderController::class, 'index'])->name('orders');
        Route::get('/tools',                    [ToolController::class, 'index'])->name('tools');
        Route::get('/adding-tools',             [ToolController::class, 'addingTools'])->name('addingTools');
        Route::post('/add-tools',               [ToolController::class, 'addTools'])->name('addTools');
        Route::get('/delete-tools/{id}',        [ToolController::class, 'deleteTools'])->name('deleteTools');

    });

});
