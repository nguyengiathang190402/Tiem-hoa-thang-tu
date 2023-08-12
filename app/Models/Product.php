<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['name', 'price', 'content', 'description', 'deleted_at', 'active', 'category_id', 'seo_keyword', 'user_id', 'image', 'slug'];

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class);

    }

     
}
