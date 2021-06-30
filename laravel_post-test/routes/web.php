<?php

Route::get('/input',function () {
    return view('input');
});
Route::post('/output', 'FormController@index');