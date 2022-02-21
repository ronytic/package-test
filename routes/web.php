<?php

Route::group(['middleware' => ['auth']], function () {
    Route::get('admin/package-test', 'PackageTestAdminController@index')->name('package.test.admin.index');
    Route::get('package-test', 'PackageTestController@index')->name('package.test.tab.index');
});
