<?php

namespace ProcessMaker\Package\PackageTest\Http\Controllers;

use ProcessMaker\Http\Controllers\Controller;
use ProcessMaker\Http\Resources\ApiCollection;
use ProcessMaker\Package\PackageTest\Models\Sample;
use RBAC;
use Illuminate\Http\Request;
use URL;


class PackageTestAdminController extends Controller
{
    public function index()
    {
        return view('package-test::index-admin');
    }
}
