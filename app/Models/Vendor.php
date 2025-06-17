<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'recurring_type',
        'is_active',
        'vendor_start',
        'vendor_end',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}