<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * @var string
     */
    protected $table = 'products';

    /**
     * @var array
     */
    protected $fillable = [
        'vendor_id', 'category_id', 'sku', 'name', 'slug', 'description', 'quantity', 'image',
        'price',  'status'];
    

    /**
     * @var array
     */
    protected $casts = [
        'quantity'  =>  'integer',
        'vendor_id'  =>  'integer',
        'category_id' => 'integer',
        'status'    =>  'boolean',
        'featured'  =>  'boolean'
    ];

     /**
     * @param $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */


    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function Vendor()
    {
         return $this->belongsTo(Vendor::class);
    }
}