<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    protected $fillable = [
        'code',
        'percent_off',
        'active',
    ];

    protected $casts = [
        'percent_off' => 'float',
        'active'      => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saving(function (self $code) {
            $code->code = strtoupper(trim($code->code));
        });
    }
}
