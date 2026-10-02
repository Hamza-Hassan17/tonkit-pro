<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    protected $fillable = [
        'key',
        'label',
        'badge_class',
        'blocks_ordering',
    ];

    protected $casts = [
        'blocks_ordering' => 'boolean',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * Keyed-by-key array shape matching the old config/product_tags.php,
     * for the Blade views that used to read that config directly
     * (tag-badges component, inventory filter pills).
     */
    public static function asConfigArray(): array
    {
        return static::all()->keyBy('key')->map(fn (self $t) => [
            'label'           => $t->label,
            'badge_class'     => $t->badge_class,
            'blocks_ordering' => $t->blocks_ordering,
        ])->all();
    }
}
