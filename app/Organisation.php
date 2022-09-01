<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    protected $fillable = [
        'company_name','company_parent_name','office_address','office_city','office_state','office_pin','mailing_address','mailing_city','mailing_state','mailing_pin','fax','entered_by','modified_by','primary_contact_name','primary_contact_email','Primary_contact_phone','Primary_contactalt_phone','Primary_contaddr'
    ];
}
