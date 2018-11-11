<?php

Route::middleware('auth:api')->namespace('Api')->group(function () {
    Route::get('/server/list', 'ServerController@list');
    Route::post('/server/add', 'ServerController@add');
    Route::post('/module/add', 'ModuleController@add');
    Route::get('/module/types', 'ModuleController@types');
});
