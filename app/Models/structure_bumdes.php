<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class structure_bumdes extends Model
{
    protected $table = 'structure_bumdes';

    protected $fillable = [
        'name',
        'position',
        'photo',
        'description',
        'email',
        'phone',
    ];

    /**
     * Get the structure's name.
     */
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Get the structure's position.
     */
    public function getPositionAttribute($value)
    {
        return ucfirst($value);
    }
}
