<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organisation_contact_info extends Model
{
    protected $fillable = [
        'organisation_name','organisation_address','organisation_contact_name','organisation_contact_email','organisation_contact_phone','organisation_contact_altphone','organisation_contact_address','entered_by','modified_by'
    ];
}
