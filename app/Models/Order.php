<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'shipping_address',
        'items_subtotal',
        'setup_fees_total',
        'shipping_total',
        'pricing_breakdown',
        'total',
        'status',
        'payment_method',
        'paypal_txn_id',
        'stripe_session_id',
        'stripe_payment_intent',
    ];

    protected $casts = [
        'total'             => 'decimal:2',
        'items_subtotal'    => 'decimal:2',
        'setup_fees_total'  => 'decimal:2',
        'shipping_total'    => 'decimal:2',
        'pricing_breakdown' => 'array',
    ];

    public function contactName(): string
    {
        return $this->customer_name ?: $this->user?->name ?: 'Customer';
    }

    public function contactEmail(): ?string
    {
        return $this->customer_email ?: $this->user?->email;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
