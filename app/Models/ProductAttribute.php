<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'type'];

    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_product_attribute')
            ->withPivot('attribute_value_id');
    }

    public function attributeValue()
    {
        return $this->belongsTo(AttributeValue::class, 'attribute_value_id');
    }
    public function isUsedInProducts()
    {
        // Kiểm tra xem có sản phẩm nào sử dụng thuộc tính này không
        return $this->products()->exists();
    }

}
