<?php

use App\Http\Controllers\Frontend;
use App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\ProductCategoryController;
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
// Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Backend', 'middleware' => ['auth']], function () {
Route::group(['middleware' => ['auth']], function() {
    // roles
    Route::resource('roles', Backend\RoleController::class);
    
    // users
    Route::resource('users', Backend\UserController::class);
    Route::post('/users/change-status', [Backend\UserController::class, 'ajaxChangeStatus'])->name('users.ajaxChangeStatus');

    // permission
    Route::resource('permissions', Backend\PermissionController::class);
    // tien-ich
    Route::resource('utilities', Backend\UtilitieController::class);
    // product
    Route::delete('products/destroy', [Backend\ProductController::class, 'massDestroy'])->name('products.massDestroy');
    Route::post('products/media', [Backend\ProductController::class, 'storeMedia'])->name('products.storeMedia');
    Route::post('products/ckmedia', [Backend\ProductController::class, 'storeCKEditorImages'])->name('products.storeCKEditorImages');
    Route::get('products/check-slug', [Backend\ProductController::class, 'checkSlug'])->name('products.checkSlug');
    Route::resource('products', Backend\ProductController::class);

    // product category
    Route::delete('product-categories/destroy', [Backend\ProductCategoryController::class,'massDestroy'])->name('product-categories.massDestroy');
    Route::post('product-categories/media', [Backend\ProductCategoryController::class, 'storeMedia'])->name('product-categories.storeMedia');
    Route::post('product-categories/ckmedia', [Backend\ProductCategoryController::class, 'storeCKEditorImages'])->name('product-categories.storeCKEditorImages');

    // Route::get('product-categories/check-slug', 'Backend\ProductCategoryController@checkSlug')->name('product-categories.checkSlug');
    Route::get('product-categories/check-slug', [Backend\ProductCategoryController::class, 'checkSlug'])->name('product-categories.checkSlug');
    Route::resource('product-categories', Backend\ProductCategoryController::class);

    // product-tags
    Route::delete('product-tags/destroy', 'ProductTagController@massDestroy')->name('product-tags.massDestroy');
    Route::resource('product-tags', Backend\ProductTagController::class);


    Route::resource('product-attributes', Backend\ProductAttributeController::class);
    Route::get('product-attributes/check-slug', [Backend\ProductAttributeController::class, 'checkSlug'])->name('attributes.checkSlug');
    Route::get('product-attributes/{productAttribute}/manage-values', [Backend\ProductAttributeController::class, 'manageValues'])->name('product-attributes.manage-values');
    Route::get('/get-values/{attributeId}', [Backend\ProductAttributeController::class, 'getValues']);
    Route::get('/get-attribute-data', [Backend\ProductController::class, 'getAttributeData']);

    // attribute-value
    Route::get('product-attributes/{productAttribute}/values', [Backend\AttributeValueController::class, 'index'])->name('attribute-values.index');
    Route::get('product-attributes/{productAttribute}/values/create', [Backend\AttributeValueController::class, 'create'])->name('attribute-values.create');
    Route::post('product-attributes/{productAttribute}/values', [Backend\AttributeValueController::class, 'store'])->name('attribute-values.store');
    Route::get('product-attributes/{productAttribute}/values/{attributeValue}/edit', [Backend\AttributeValueController::class, 'edit'])->name('attribute-values.edit');
    Route::put('product-attributes/{productAttribute}/values/{attributeValue}', [Backend\AttributeValueController::class, 'update'])->name('attribute-values.update');
    Route::delete('product-attributes/{productAttribute}/values/{attributeValue}', [Backend\AttributeValueController::class, 'destroy'])->name('attribute-values.destroy');
    Route::get('product-attributes/{productAttribute}/values/{attributeValue}', [Backend\AttributeValueController::class, 'show'])->name('attribute-values.show');

    // upload image
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

