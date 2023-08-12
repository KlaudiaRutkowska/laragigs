<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//common resource routes:
//index - show all listings
//show - show single listing
//create - show form to create new listing
//store - create new listing
//edit - show form to edit listing
//update - update listing
//destroy - delete listing

//all listings
Route::get('/', [ListingController::class, 'index'])->name('home');

//show create form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

//store listing data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

//show all user's listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

//edit listing
Route::get('listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

//update listing data
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

//update listing data
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

//single listing
Route::get('/listings/{listing}', [ListingController::class, 'show'])->name('listing.show');

//show register/create form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

//store user data
Route::post('/users', [UserController::class, 'store']);

//show login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

//login user
Route::post('users/authenticate', [UserController::class, 'authenticate']);

//logout user
Route::get('/logout', [UserController::class, 'logout']);

//show all user's listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');



//Route::get('/listings/{listing}', 'ListingController@show');

// Route::get('/', function () {
//     return view('listings', [
//         'listings' => Listing::all(),
//     ]);
// });

// Route::get('/listings/{listing}', function (Listing $listing) {
//     return view('listing', [
//         'listing' => $listing,
//     ]);
// });

// Route::get('/listings/{id}', function ($id) {
//     $listing = Listing::find($id);

//     if($listing) {
//         return view('listing', [
//             'listing' => $listing,
//         ]);
//     }

//     return abort('404');
// });

// Route::get('/hello', function() {
//     return response('hello!', 200)
//     ->header('Content-Type', 'text/plain')
//     ->header('foo', 'bar');
// });

// Route::get('/posts/{id}', function($id) {
//     return response('post: ' . $id);
// });

// Route::get('/search', function(Request $request) {
//     return $request->name . ' ' . $request->city;
// });
