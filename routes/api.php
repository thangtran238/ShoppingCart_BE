<?php
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use App\Http\Controllers\LazadaController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::get('/api-data', function () {
//     $client = new Client();
//     $response = $client->request('GET', 'https://api.example.com/data');

//     return $response->getBody();
// });

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
	});

	Route::get('get-product',[APIController::class,'getProducts']);
	Route::get('get-product/{id}',[ APIController::class,'getOneProduct']);
    
    Route::post('checkout', [ APIController::class,'checkOutCart']);

