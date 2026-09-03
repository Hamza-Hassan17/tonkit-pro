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
        return collect(config('products.list'))->firstWhere('slug', $this->product_slug);
    }
}
