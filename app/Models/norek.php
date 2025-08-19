<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class norek extends Model
{
    protected $table = 'noreks';

    protected $fillable = [
        'nama_bank',
        'norek',
        'atas_nama',
    ];

    /**
     * Get the bank name.
     */
    public function getBankNameAttribute(): string
    {
        return $this->nama_bank;
    }

    /**
     * Get the account number.
     */
    public function getAccountNumberAttribute(): string
    {
        return $this->norek;
    }

    /**
     * Get the account holder's name.
     */
    public function getAccountHolderNameAttribute(): string
    {
        return $this->atas_nama;
    }
}
