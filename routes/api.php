<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) { // auth:api
    return $request->user();
});

Route::get('/items', [ItemController::class, 'index']); 

// Route::middleware('api')->group(function () {                // automatic routes for all default resources
//    Route::resource('items', ItemController::class);
// }); 

Route::prefix('/item')->group( function () { 
        Route::post('/store', [ItemController::class, 'store']); // item/store
        Route::put('/{id}', [ItemController::class, 'update']); // item/{id} // {id} = parameter
        Route::delete('/{id}', [ItemController::class, 'destroy']);  
    }   
);

