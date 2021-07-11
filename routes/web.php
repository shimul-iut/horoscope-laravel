<?php

use App\Models\Zodiac;
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

Route::get('/', function () {
    $signs = Zodiac::all();
    return view('welcome', compact('signs'));
});
Route::get('/calender/{year}/{sign}', 'App\Http\Controllers\CalenderController@index');



