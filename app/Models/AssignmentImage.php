<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignmentImage extends Model
{
    protected $table = 'assignment_images';

    protected $fillable = ['assignment_details_id', 'thumbnail', 'full'];

    protected $casts = [
        'assignment_details_id'    =>  'integer',
    ];

    public function assignmentdetails()
    {
        return $this->belongsTo(AssignmentDetails::class);
    }
}
