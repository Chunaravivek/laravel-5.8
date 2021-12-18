<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'name', 'package_name', 'created_date', 'modified_date', 'status'
    ];
}
