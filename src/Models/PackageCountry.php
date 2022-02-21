<?php

namespace ProcessMaker\Package\PackageTest\Models;

use Illuminate\Database\Eloquent\Model;

class PackageCountry extends Model
{
    protected $table = 'sample_skeleton';

    protected $fillable = [
        'id', 'name', 'status'
    ];
}
