<?php

Route::group(['middleware' => ['auth']], function () {
    Route::get('admin/package-test', 'PackageTestController@index')->name('package.skeleton.index');
    Route::get('package-test', 'PackageTestController@index')->name('package.skeleton.tab.index');
});
