<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;

    protected $fillable = ['product_attribute_id', 'value', 'quantity'];

    public function productAttribute()
    {
        return $this->belongsTo(ProductAttribute::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_product_attribute', 'attribute_value_id', 'product_id');
    }
    
    public function isUsedInProducts()
    {
        return $this->products()->exists();
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
