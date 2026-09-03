<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_slug',
        'product_name',
        'color',
        'color_name',
        'price',
        'qty',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    // Look the live product back up from config, e.g. for its current image.
    // Falls back gracefully if the product was later removed from the catalog.
    public function product(): ?array
    {
        return \App\Http\Controllers\ProductController::find($this->product_slug);
    }

    // Image for the purchased color, falling back to the product default.
    public function image(): ?string
    {
        $product = $this->product();
        if (! $product) {
            return null;
        }

        return \App\Http\Controllers\ProductController::color($product, $this->color)['image'] ?? $product['image'];
    }
}
