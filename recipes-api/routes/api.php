<?php

use App\Http\Controllers\AuthController;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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

Route::get('/test', function(){
    $data = Http::acceptJson()->get('https://api.spoonacular.com/recipes/complexSearch', [
        'number' => 100,
        'apiKey' => '6c9c38417618439490846ef1dbe0ec64'
    ]);

    $data = $data['results'];
    $new = array();
    foreach($data as $obj){
        unset($obj['imageType']);
        array_push($new, $obj);
    };
    // return $data;    
    return $new;    
});

//UNPROTECTED ROUTES
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// PROTECTED ROUTES
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);

});

