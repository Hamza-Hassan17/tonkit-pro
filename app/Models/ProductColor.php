<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductColor extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'slug',
        'hex',
        'image_path',
        'sort_order',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /** Plain-array shape matching config/products.php's colors entries. */
    public function toLegacyArray(): array
    {
        return [
            'name'  => $this->name,
            'slug'  => $this->slug,
            'hex'   => $this->hex,
            'image' => $this->image_path,
        ];
    }
}
