<?php

namespace App\Models;
use App\District;
use App\Block;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = [
        'client_name', 'district_id', 'block_id', 'email', 'phone', 'contact_name', 'status'
    ];

    public function district() {
        return $this->belongsTo(District::class);
    }

    public function block() {
        return $this->belongsTo(Block::class);
    }
}
