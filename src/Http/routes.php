<?php
Route::group(['prefix' => config('laracvr.route_prefix')], function () {
    Route::get('/company/{cvr}', 'LaracvrController@company');
    Route::get('production/{p}', 'LaracvrController@production');
});
