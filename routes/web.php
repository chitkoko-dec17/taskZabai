<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoteController;

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
Route::get('/','VoteController@lastestvote');
Route::get('vote-result', 'VoteController@voteresult');
Route::get('vote-question', 'VoteController@lastestvote');
Route::post('vote', 'VoteController@dovote');
Route::get('question', 'VoteController@question');
Route::post('create-question', 'VoteController@createquestion');
Route::get('vote-count/{id}', 'VoteController@getvotecount');