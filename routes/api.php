<?php

// use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::namespace('Notes')->group(function(){
    
    Route::prefix('notes')->group(function(){
        Route::post('create','NoteController@store');
        Route::get('','NoteController@index');
        Route::get('{note}','NoteController@show')->name('note.show');
        Route::patch('{note}/update','NoteController@update')->name('note.update');
        Route::delete('{note}/delete','NoteController@destroy')->name('note.delete');

    });
    Route::prefix('subjects')->group(function(){
        Route::get('','SubjectController@index');

    });

});