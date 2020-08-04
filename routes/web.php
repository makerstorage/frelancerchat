<?php

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
    return view('welcome');
});


Route::get('/test', 'MessageController@test');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/contacts', 'ContactsController@get');
Route::get('/conversation/{id}', 'ContactsController@getMessagesFor');
Route::post('/conversation/send', 'ContactsController@send');

Route::get('/getuser/{id}', 'ContactsController@getUser');
Route::get('/serkan', function () {
    return view('serkan-profil');
    //serkan - buraya profile girdigimizde id elimizde olacagindan view e direk aktarabiliriz.
    $with_id = 5;
    //end serkan
});
Route::get('/nuri', function () {
    //serkan
    $with_id = 15;
    //end serkan
    return view('nuri-profil');
});

