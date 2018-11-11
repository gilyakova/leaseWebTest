<?php

Route::middleware('auth:api')->namespace('Api')->group(function () {
    Route::get('/server/list', 'ServerController@list');
    Route::post('/server/add', 'ServerController@add');
    Route::delete('/server/{serverId}', 'ServerController@delete')->where('serverId', '[0-9]+');
    Route::get('/module/types', 'ModuleController@types');
    Route::post('/module/add', 'ModuleController@add');
    Route::delete('/module/{moduleId}', 'ModuleController@delete')->where('moduleId', '[0-9]+');
});
