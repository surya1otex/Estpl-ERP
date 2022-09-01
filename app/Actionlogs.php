<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actionlogs extends Model
{
    //
    protected $primaryKey = 'assign_details_id';
    protected $fillable = [
        'update_status', 'assign_details_id', 'assignment_id', 'comments', 'image', 'lat', 'long'
    ];
}
