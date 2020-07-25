<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    //
    
    protected $fillable = [
        'number',
        'text',
        'file_path1',
        'file_path2',
        'region_id',
        'region_name',
        'user_email',
        'status',
        'description'
    ];
}
