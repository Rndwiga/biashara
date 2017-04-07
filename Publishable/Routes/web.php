<?php

event('biashara.routing', app('router'));
$namespaceController = '\\'.'Tyondo\Biashara\Http\Controllers'.'\\';

Route::get('/', $namespaceController.'BiasharaFrontEndController@index')->name('biashara.index');
Route::get('/about', $namespaceController.'BiasharaFrontEndController@about')->name('biashara.about');
Route::get('/contact', $namespaceController.'BiasharaFrontEndController@contact')->name('biashara.contact');
Route::post('/contact', $namespaceController.'BiasharaFrontEndController@storeContact')->name('contact.store');
Route::post('/order/details', function (){
    $input = Illuminate\Support\Facades\Input::all();
    foreach ($input as $key=>$data){
        echo $key . '=> '. $data;
        echo '<br>';
    }
    exit;
    return $input;
});

Route::group(['prefix'=>'auth'], function(){
    event('biashara.routing',app('router'));
    $namespaceController = '\\'.'Tyondo\Biashara\Http\Controllers\Auth'.'\\';
       Route::post('/login',$namespaceController.'LoginController@login')->name('biashara.auth.login');
       Route::post('/register',$namespaceController.'RegisterController@register')->name('biashara.auth.register');
});
