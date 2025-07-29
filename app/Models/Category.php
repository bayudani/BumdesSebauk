<?php

namespace App\Models;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // tabel
    protected $table = 'categories';
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
    ];

    // relationships
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
