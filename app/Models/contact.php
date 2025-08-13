<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    protected $table = 'contacts';

    protected $fillable = [
        'name',
        'no_hp',
    ];

    /**
     * Get the contact's name.
     */
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Get the contact's phone number.
     */
    public function getNoHpAttribute($value)
    {
        // Mengganti awalan '0' dengan '62' (tanpa '+') agar kompatibel dengan URL WhatsApp
        return preg_replace('/^0/', '62', $value);
    }
}
