<?php

event('biashara.routing', app('router'));
$namespaceController = '\\'.'Tyondo\Biashara\Http\Controllers'.'\\';

Route::get('/', $namespaceController.'BiasharaFrontEndController@index')->name('biashara.index');
Route::get('/about', $namespaceController.'BiasharaFrontEndController@about')->name('biashara.about');
Route::get('/contact', $namespaceController.'BiasharaFrontEndController@contact')->name('biashara.contact');
Route::post('/contact', $namespaceController.'BiasharaFrontEndController@storeContact')->name('contact.store');
Route::post('/order/details', $namespaceController.'BiasharaOrdersController@storeOrder');

Route::group(['prefix'=>'auth'], function(){
    event('biashara.routing',app('router'));
    $namespaceController = '\\'.'Tyondo\Biashara\Http\Controllers\Auth'.'\\';
       Route::post('/login',$namespaceController.'LoginController@login')->name('biashara.auth.login');
       Route::post('/register',$namespaceController.'RegisterController@register')->name('biashara.auth.register');
});
