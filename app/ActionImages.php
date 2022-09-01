<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActionImages extends Model
{
    //
    protected $fillable = [
        'service_task_id', 'image'
    ];
}
