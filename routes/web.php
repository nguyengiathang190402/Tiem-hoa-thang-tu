<?php

use App\Http\Controllers\Frontend;
use App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
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
    Route::resource('roles', Backend\RoleController::class);
    Route::resource('users', Backend\UserController::class);
    Route::resource('permissions', Backend\PermissionController::class);
    Route::resource('utilities', Backend\UtilitieController::class);
    Route::resource('products', Backend\ProductController::class);
    // product category
    Route::delete('product-categories/destroy', 'ProductCategoryController@massDestroy')->name('product-categories.massDestroy');
    Route::post('product-categories/media', 'ProductCategoryController@storeMedia')->name('product-categories.storeMedia');
    Route::post('product-categories/ckmedia', 'ProductCategoryController@storeCKEditorImages')->name('product-categories.storeCKEditorImages');
    Route::get('product-categories/check-slug', 'ProductCategoryController@checkSlug')->name('product-categories.checkSlug');
    Route::resource('product-categories', Backend\ProductCategoryController::class);

    Route::delete('product-tags/destroy', 'ProductTagController@massDestroy')->name('product-tags.massDestroy');
    Route::resource('product-tags', Backend\ProductTagController::class);

    Route::get('impersonate/user/{id}', [Backend\UserController::class, 'impersonate' ]);
    Route::get('products/images/{filename}', function ($filename) {
        $path = storage_path('app/public/products/' . $filename);
        if (!File::exists($path)) {
            abort(404);
        }
    
        $file = File::get($path);
        $type = File::mimeType($path);
    
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
    
        return $response;
    })->name('product.image');
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

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

