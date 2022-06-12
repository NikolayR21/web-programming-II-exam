<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CuisineController;
use App\Http\Controllers\DietController;
use App\Http\Controllers\DishTypeController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\OccasionController;
use App\Http\Controllers\RecipeController;
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
    $data = Http::acceptJson()->get('https://api.spoonacular.com/recipes/random', [
        'number' => 20,
        'apiKey' => '6c9c38417618439490846ef1dbe0ec64'
    ]);
    
    $data = $data['recipes'];
    foreach($data as $recipe){
        return $recipe['analyzedInstructions'][0]['steps'];
    }
    return $data;    
    // $new = array();
    // foreach($data as $obj){
    //     unset($obj['imageType']);
    //     array_push($new, $obj);
    // };
    // return $new;    
});


//UNPROTECTED ROUTES

// *** Recipes ***
Route::get('/recipes', [RecipeController::class, 'index']);

// *** Diets ***
Route::get('/diets', [DietController::class, 'index']);

// *** Cuisines ***
Route::get('/cuisines', [CuisineController::class, 'index']);

// *** Ingredients ***
Route::get('/ingredients', [IngredientController::class, 'index']);

// *** Dish types ***
Route::get('/dishTypes', [DishTypeController::class, 'index']);

// *** Occasions ***
Route::get('/occasions', [OccasionController::class, 'index']);
// Route::post('/occasions', [OccasionController::class, 'store']);
// Route::delete('/occasions/{id}', [OccasionController::class, 'destroy']);

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// PROTECTED ROUTES
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);

});

