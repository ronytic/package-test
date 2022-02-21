<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// Command for install package
Artisan::command('package-test:install', function () {
    // Create the package tables
    if (!Schema::hasTable('package_countries')) {
        Schema::create('package_countries', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->increments('id');
            $table->string('country');
            $table->string('region');
            $table->string('country_id');
            $table->enum('status', ['ENABLED', 'DISABLED'])->default('ENABLED');
            $table->timestamps();
        });
    }
    Artisan::call('vendor:publish', [
        '--tag' => 'package-test',
        '--force' => true
    ]);

    $this->info('Package Test has been installed');
})->describe('Installs the required js files and table in DB');


// Command for uninstall package
Artisan::command('package-test:uninstall', function () {
    // Drop the package tables
    if (Schema::hasTable('package_countries')) {
        Schema::drop('package_countries');
    }

    $this->info('Package Test has been uninstalled');
})->describe('Uninstalls the required js files and table in DB');

// Command for truncate table package_countries
Artisan::command('package-test:truncate', function () {
    // Drop the package tables
    if (Schema::hasTable('package_countries')) {
        DB::table('package_countries')->truncate();
    }

    $this->info('Package Test has been truncated');
})->describe('Truncates the package_countries table in DB');
