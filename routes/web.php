<?php

use App\Http\Controllers\AboutServiceController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\DetailsController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ShowcaseController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\UserAuthcontroller;
use App\Http\Controllers\Websitecontroller;
use Illuminate\Support\Facades\Route;

//User Page    
Route::get('/', [UserAuthController::class, 'home']);
//to open register page
Route::get("register", [RegisterController::class, "register"]);
//to open login page
Route::get("login", [RegisterController::class, "login"]);

//register
Route::post("register",[UserAuthcontroller::class,"register"]);
//Login
Route::post("login",[UserAuthcontroller::class,"login"]);
//to open about us page
Route::get('/pages/about-us', [UserAuthcontroller::class, 'aboutUs'])->name('about-us');
//to open sale page
Route::get('/collection/sale-products', [UserAuthcontroller::class, 'sale'])->name('sale');
//to open sale page
Route::get('/contact-us', [UserAuthcontroller::class, 'contactus'])->name('contactus');
//to open collections page
Route::get('/collections', [UserAuthcontroller::class, 'collections'])->name('collections');

//to open womens-fragrances page
Route::get('/collections/womens-fragrances', [UserAuthcontroller::class, 'womensfragrances']);
//to open mens-fragrances page
Route::get('/collections/mens-fragrances', [UserAuthcontroller::class, 'mensfragrances']);
//to open sale page
Route::get('/collections/travel-size', [UserAuthcontroller::class, 'travelsize']);
//to open sale page
Route::get('/collections/discovery', [UserAuthcontroller::class, 'discovery']);
//to open blogs page
Route::get('/blogs', [UserAuthcontroller::class, 'blogs']);
//to open product details page
Route::get('/product-details', [UserAuthcontroller::class, 'details']);

Route::group([
    "middleware" => ["auth:sanctum"]
],function(){

//Logout
Route::post("logout",[UserAuthcontroller::class,"logout"]);
//to logout normal user
Route::post('logoutuser', [UserAuthcontroller::class, 'logoutuser']);
//to change password
Route::post("changePassword",[UserAuthcontroller::class,"changePassword"]);

});

Route::group(['middleware' => ['admin.auth'], 'prefix' => 'admin'], function() {
    Route::get("", [UserAuthcontroller::class, "admin"]);
    Route::get("users", [UserAuthcontroller::class, "users"]);
    Route::get("add-carousel-data", [CarouselController::class, "addcarouseldata"]);
    Route::get("add-showcase-data", [ShowcaseController::class, "addshowcasedata"]);
    Route::get("add-products", [ProductsController::class, "addproducts"]);
    Route::get("add-details", [DetailsController::class, "adddetails"]);
    Route::get("product-options", [OptionController::class, "productoptions"]);
    Route::get("add-story", [StoryController::class, "addstory"]);
});

//to get user data
Route::post('/get-user-data', [UserAuthcontroller::class, 'getUserData'])->name('user.getData');
//to edit user
Route::post('/users/{id}/edit', [UserAuthController::class, 'editUser']);
//to delet user
Route::post('/delete-user', [UserAuthcontroller::class, 'deleteUser'])->name('delete.user');
//to add carousel data
Route::post('/carousel/store', [CarouselController::class, 'store'])->name('carousel.store');
//to get carousel
Route::get('/get-carousel/{id}', [CarouselController::class, 'getcarousel']);
//to edit carousel
Route::post('/update-carousel/{id}', [CarouselController::class, 'updatecarousel'])->name('update.carousel');
//to delet carousel
Route::post('/delete-carousel', [CarouselController::class, 'deletecarousel'])->name('delete.carousel');
//to add showcase data
Route::post('/showcase/store', [ShowcaseController::class, 'store'])->name('showcase.store');
//to get showcase data
Route::get('/showcase/{id}', [ShowcaseController::class, 'show'])->name('showcase.show');
// Update showcase data
Route::post('/showcase/{id}', [ShowcaseController::class, 'update'])->name('showcase.update');
//to delet showcase
Route::post('/delete-showcase', [ShowcaseController::class, 'deleteshowcase'])->name('delete.showcase');
//to add product data
Route::post('/save-product', [ProductsController::class, 'store'])->name('product.store');
//to get product data
Route::get('/product/{id}', [ProductsController::class, 'show'])->name('product.show');
// Update product data
Route::post('/product/update/{id}', [ProductsController::class, 'update'])->name('product.update');
//to delet product
Route::post('/delete-product', [ProductsController::class, 'deleteproduct'])->name('delete.product');
//to add detail data
Route::post('/detail/store', [DetailsController::class, 'store'])->name('detail.store');
//to get detail data
Route::get('/detail/{id}', [DetailsController::class, 'show'])->name('detail.show');
// Update detail data
Route::post('/detail/{id}', [DetailsController::class, 'update'])->name('detail.update');
//to delet detail
Route::post('/delete-detail', [DetailsController::class, 'deletedetail'])->name('delete.detail');
//to show explore page
Route::get('/explore-product/{slug}', [ProductsController::class, 'exploreProduct'])->name('single.product.page');
//to add option
Route::post('/api/add-option', [OptionController::class, 'addOption']);
 //to get option data
Route::get('/option/{id}', [OptionController::class, 'show'])->name('option.show');
// Update option data
Route::post('/option/{id}', [OptionController::class, 'update'])->name('option.update');
//to delet option
Route::post('/delete-options', [OptionController::class, 'deleteoption'])->name('delete.option');
//to add story data
Route::post('/story/store', [StoryController::class, 'store'])->name('story.store');
//to get story data
Route::get('/story/{id}', [StoryController::class, 'show'])->name('story.show');
// Update story data
Route::post('/story/{id}', [StoryController::class, 'update'])->name('story.update');
//to delet story
Route::post('/delete-story', [StoryController::class, 'deletestory'])->name('delete.story');