<?php

namespace App\Models;
use App\District;
use App\Block;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        'subject', 'district_id', 'block_id', 'organisation_id', 'user_id'
    ];

    public function district() {
        return $this->belongsTo(District::class);
    }

    public function block() {
        return $this->belongsTo(Block::class);
    }
    
    public function organisation() {
        return $this->belongsTo(Organisation::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
