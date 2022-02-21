<?php
Route::group(['middleware' => ['auth:api', 'bindings']], function () {
    Route::get('admin/package-test/fetch', 'PackageTestController@fetch')->name('package.skeleton.fetch');
    Route::apiResource('admin/package-test', 'PackageTestController');

    // New Endpoints
    Route::post('admin/package-test/searchcountries', 'PackageTestAdminController@searchCountries')->name('package.test.admin.index');
    Route::post('admin/package-test/savecountry', 'PackageTestAdminController@store')->name('package.test.admin.store');
});
