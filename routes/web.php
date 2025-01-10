<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

// FRONT END
Route::view('/about', 'frontend.about');
Route::view('/thanks', 'frontend.thanks');
Route::redirect('/admin', '/admin/login');

Route::controller(UserController::class)->group(function () {
  Route::get('/login',    'showLogin');
  Route::get('/logout',   'logout');
  Route::get('/register', 'showRegister');

  Route::post('/login',    'login');
  Route::post('/register', 'register');
});

Route::controller(AdminController::class)->group(function () {
  Route::get('/admin/login',          'showLogin');
  Route::get('/admin/users',          'showUsers');
  Route::get('/admin/games',          'showGames');
  Route::get('/admin/logout',         'logout');
  Route::get('/api/admin/users/{id}', 'getUser');
  Route::get('/api/admin/games/{id}', 'getGame');
  
  Route::post('/admin/login',          'login');
  Route::post('/admin/users/delete',   'deleteUsers');
  Route::post('/admin/games/delete',   'deleteGames');
  Route::post('/api/admin/users/edit', 'editUser');
  Route::post('/api/admin/games/edit', 'editGame');
});

Route::controller(GameController::class)->group(function () {
  Route::get('/',              'showIndexGames');
  Route::get('/cart',          'showCart');
  Route::get('/browse',        'showGames');
  Route::get('/checkout',      'showCheckout');
  Route::get('/games/publish', 'showPublish');
  Route::get('/games/{id}',    'showGame');
  
  Route::post('/checkout',            'checkout');
  Route::post('/cart/new',            'addToCart');
  Route::post('/cart/delete',         'deleteFromCart');
  Route::post('/cart/modify',         'modifyQuantity');
  Route::post('/games/publish',       'publish');
  Route::post('/games/review/new',    'reviewGame');
  Route::post('/admin/games/publish', 'publish');
});