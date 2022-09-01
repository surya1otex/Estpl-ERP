<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActionTaken extends Model
{
    protected $primaryKey = 'assign_details_id';
    public $incrementing = false;
    protected $fillable = [
        'update_status', 'assign_details_id', 'assignment_id', 'comments', 'image', 'lat', 'long'
    ];
}
