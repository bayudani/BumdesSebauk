<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{

    protected $table = 'products';
    public $incrementing = false; // UUID bukan auto-increment
    protected $keyType = 'string'; // UUID berupa string

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
    }

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category_id',
        'stok',
    ];

    // relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function images()
    {
        return $this->hasMany(Product_image::class, 'product_id');
    }
}
