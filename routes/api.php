<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
/*Route::get('/products', function (){
    return Product::factory(10)->create();
});*/
//Route::apiResource('/product', ProductController::class);

Route::apiResources([
    'product' => ProductController::class,
    'category' => CategoryController::class,
    'user' =>UserController::class
]);

Route::get('custom',[CategoryController::class,'custom']);
Route::get('custom1' , [ProductController::class, 'custom1']);
Route::get('custom2' , [ProductController::class, 'custom2']);
Route::get('report1' , [ProductController::class, 'report1']);

