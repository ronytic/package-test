<?php
Route::group(['middleware' => ['auth:api', 'bindings']], function() {
    Route::get('admin/package-test/fetch', 'PackageTestController@fetch')->name('package.skeleton.fetch');
    Route::apiResource('admin/package-test', 'PackageTestController');
});
