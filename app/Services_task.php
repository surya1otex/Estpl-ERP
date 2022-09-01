<?php

namespace App;

use App\Models\Product;
use App\Models\Assignment;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Services_task extends Model
{
    protected $fillable = [
        'product_id', 'assignment_id', 'assignmnt_item_id', 'user_id', 'status'
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function assignment() {
        return $this->belongsTo(Assignment::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
