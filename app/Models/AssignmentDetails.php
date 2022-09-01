<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignmentDetails extends Model
{

    //protected $primaryKey = 'product_id';
    
    protected $fillable = [
        'assignment_id',  'product_id', 'model','organisation_location_id', 'distributor', 'serial_number','war_issued_at','war_expires_at', 'status'
    ];
   

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function assignment() {
        return $this->belongsTo(Assignment::class);
    }
    public function images() {
        return $this->hasMany(AssignmentImage::class);
    }
    public function organisation_location() {
        return $this->belongsTo(Organisation_location::class);
    }
}
