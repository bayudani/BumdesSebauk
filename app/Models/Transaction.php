<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaction extends Model
{
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
        'product_id',
        'customer_name',
        'customer_address',
        'customer_phone',
        'quantity',
        'total_amount',
        'status',
        'transaction_date',
        'payment_method',
        'proof of transaction',
    ];

    // relationships
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function category()
    {
        return $this->hasOneThrough(Category::class, Product::class, 'id', 'id', 'product_id', 'category_id');
    }
}
