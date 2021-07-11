<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\ZodiacResource;
use App\Http\Resources\CalenderResource;

use App\Models\Zodiac;
use App\Models\HoroscopeCalender;
use App\Models\HoroscopeScore;

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
Route::prefix('v1')->group(function () {

    Route::get('/zodiacs', function(){
        return ZodiacResource::collection(Zodiac::all());
    });
    
    Route::get('/zodiacs/{id}', function ($id){
        return new ZodiacResource(Zodiac::findOrFail($id));
    });

    Route::post('/calender/create', 'App\Http\Controllers\CalenderController@store');

    Route::post('/populate-all-zodiacs', 'App\Http\Controllers\CalenderController@allZodiacs');

    Route::get('/day/{id}', function ($id) {
        return new CalenderResource(HoroscopeScore::findOrFail($id));
    });
});