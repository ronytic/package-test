<?php
Route::group(['middleware' => ['auth:api', 'bindings']], function () {

    // New Endpoints
    Route::post('admin/package-test/searchcountries', 'PackageTestAdminController@searchCountries')->name('package.test.admin.searchcountries');
    Route::post('admin/package-test/savecountry', 'PackageTestAdminController@store')->name('package.test.admin.store');
    Route::get('admin/package-test/getregisters', 'PackageTestAdminController@getregisters')->name('package.test.admin.getregisters');

    Route::post('admin/package-training/updatecountry/{id_country}', 'PackageTestAdminController@update')->name('package.test.admin.update');

    // Sample endpoints
    Route::get('admin/package-test/fetch', 'PackageTestController@fetch')->name('package.skeleton.fetch');
    Route::apiResource('admin/package-test', 'PackageTestController');
});
