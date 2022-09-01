<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organisation_location extends Model
{
     protected $fillable = [
       'organisation_name','organisation_location_name','organisation_address','organisation_city','organisation_state','organisation_pin','entered_by','modified_by'
    ];
}
