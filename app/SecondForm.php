<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecondForm extends Model
{
    //
    protected $fillable = [
        'first_id',
        'file_path1',
        'file_path2',
        'file_path3',
        'length_optic',
        'mobile_technology',
        'object_type',
        'region_id',
        'status',
        'description'
    ];
}
