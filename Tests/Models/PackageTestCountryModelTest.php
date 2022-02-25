<?php

namespace ProcessMaker\Package\PackageTest\Tests\Models;

use Tests\TestCase;
use Tests\Feature\Shared\RequestHelper;
use ProcessMaker\Package\PackageTest\Models\PackageCountry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class PackageTestCountryModelTest extends TestCase
{
    function __construct()
    {
        parent::__construct();
        Artisan::call('package-test:install');
    }

    function testName()
    {
        // $this->markTestSkipped('Incomplete Test working on the test');
        $this->assertEquals(1, 1);
    }


    public function testCheckStoreCountry()
    {
        $packageCountry = PackageCountry::store(new Request([
            'country' => 'country',
            'region' => 'valueTest',
            'country_id' => 'valueTest',
            'status' => 'ENABLED'
        ]));

        $this->assertInstanceOf(PackageCountry::class, $packageCountry);
    }
}
