<?php

use App\Http\Controllers\AboutServiceController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingsController;
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
});

//to get user data
Route::post('/get-user-data', [UserAuthcontroller::class, 'getUserData'])->name('user.getData');
//to edit user
Route::post('/users/{id}/edit', [UserAuthController::class, 'editUser']);
//to delet user
Route::post('/delete-user', [UserAuthcontroller::class, 'deleteUser'])->name('delete.user');
 