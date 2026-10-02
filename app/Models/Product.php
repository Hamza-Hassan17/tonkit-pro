<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'slug',
        'name',
        'brand',
        'card_label',
        'price',
        'pricing_tiers',
        'sku',
        'description',
        'specs',
    ];

    protected $casts = [
        'price'         => 'float',
        'pricing_tiers' => 'array',
        'specs'         => 'array',
    ];

    public function colors(): HasMany
    {
        return $this->hasMany(ProductColor::class)->orderBy('sort_order');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Plain-array shape matching a config/products.php entry, so
     * ProductController is the only file that needs to change when the
     * catalog moves from static config to this table -- everything
     * downstream (Pricing::breakdown(), CartController, every Blade view)
     * reads products as plain arrays, and array_merge() on an Eloquent
     * model would throw. Caller should eager-load colors/tags first
     * (Product::with(['colors', 'tags'])) to avoid N+1 queries.
     */
    public function toLegacyArray(): array
    {
        return [
            'slug'        => $this->slug,
            'name'        => $this->name,
            'brand'       => $this->brand,
            'card_label'  => $this->card_label,
            'price'       => $this->price,
            'pricing'     => ['tiers' => $this->pricing_tiers],
            'sku'         => $this->sku,
            'description' => $this->description,
            'specs'       => $this->specs ?? [],
            'tags'        => $this->tags->pluck('key')->all(),
            'colors'      => $this->colors->map->toLegacyArray()->all(),
        ];
    }
}
