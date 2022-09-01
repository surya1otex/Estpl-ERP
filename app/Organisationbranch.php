<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organisationbranch extends Model
{
   protected $fillable = [
        'organisation_name','organisation_branchname','organisation_address','organisation_city','organisation_state','organisation_pin','entered_by','modified_by'
    ];
}
