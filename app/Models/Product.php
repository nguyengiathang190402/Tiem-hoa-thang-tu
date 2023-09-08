<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['name', 'price', 'content', 'description', 'deleted_at', 'active', 'category_id', 'seo_keyword', 'user_id', 'updated_by', 'image', 'slug', 'quantity'];

    protected $appends = [
        'photo',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class);

    }

    public function attributes()
    {
        return $this->belongsToMany(ProductAttribute::class, 'product_product_attribute')
            ->withPivot('attribute_value_id');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);

    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public function tags()
    {
        return $this->belongsToMany(ProductTag::class);

    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by'); // Sử dụng trường updated_by nếu bạn đã thêm nó vào bảng products
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getPhotoAttribute()
    {
        $file = $this->getMedia('photo')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
        }

        return $file;

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
