<?php

use App\Http\Controllers\Frontend;
use App\Http\Controllers\Backend;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('permissions', PermissionController::class);
});
Route::get('/',[Frontend\ClientController::class,'index'])->name('index');
Route::get('cart',[Frontend\ClientController::class,'cart'])->name('cart');
Route::get('/single',[Frontend\ClientController::class,'single'])->name('single');
// Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
// Route::get('/dashboard',[Backend\DashboardController::class,'index'])->name('dashboard');
// Route::get('/login',[Backend\LoginController::class,'index'])->name('login');
// Route::post('/login',[Backend\LoginController::class,'postLogin'])->name('login');
// Route::get('/register',[Backend\RegisterController::class,'index'])->name('register');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

