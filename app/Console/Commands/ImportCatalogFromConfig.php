<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * One-time (but safe to re-run) import of the static config/products.php +
 * config/product_tags.php catalog into the new products/product_colors/tags
 * tables. Idempotent: upserts by slug/key, so re-running after editing
 * config just syncs changes rather than duplicating rows.
 *
 * Part of the admin-panel migration (see
 * C:/Users/lenovo/.claude/plans/woolly-hatching-starfish.md) -- this is
 * step 2, building the DB side only. ProductController still reads
 * config/products.php until the cutover step; running this command is
 * harmless to the live storefront.
 */
class ImportCatalogFromConfig extends Command
{
    protected $signature = 'catalog:import-from-config {--dry-run : Report what would happen without writing anything}';

    protected $description = 'Import config/products.php and config/product_tags.php into the database';

    public function handle(): int
    {
        $dryRun = (bool) $this->option('dry-run');

        $this->importTags($dryRun);
        $this->importProducts($dryRun);

        return self::SUCCESS;
    }

    private function importTags(bool $dryRun): void
    {
        $tags = config('product_tags', []);
        $this->info('Tags: '.count($tags).' defined in config.');

        foreach ($tags as $key => $def) {
            if ($dryRun) {
                $this->line("  would upsert tag '{$key}'");

                continue;
            }

            Tag::updateOrCreate(
                ['key' => $key],
                [
                    'label'           => $def['label'],
                    'badge_class'     => $def['badge_class'],
                    'blocks_ordering' => $def['blocks_ordering'] ?? false,
                ]
            );
        }

        if (! $dryRun) {
            $this->info('Tags imported: '.Tag::count().' rows in DB.');
        }
    }

    private function importProducts(bool $dryRun): void
    {
        $products = config('products.list', []);
        $this->info('Products: '.count($products).' defined in config.');

        foreach ($products as $p) {
            if ($dryRun) {
                $this->line("  would upsert product '{$p['slug']}' (".count($p['colors']).' colors, '.count($p['tags'] ?? []).' tags)');

                continue;
            }

            DB::transaction(function () use ($p) {
                $product = Product::withTrashed()->updateOrCreate(
                    ['slug' => $p['slug']],
                    [
                        'name'          => $p['name'],
                        'brand'         => $p['brand'] ?? 'CapBeast',
                        'card_label'    => $p['card_label'] ?? null,
                        'price'         => $p['price'],
                        'pricing_tiers' => $p['pricing']['tiers'] ?? [$p['price']],
                        'sku'           => $p['sku'],
                        'description'   => $p['description'],
                        'specs'         => $p['specs'] ?? [],
                        'deleted_at'    => null,
                    ]
                );

                // Colors: replace wholesale on re-import so removed/reordered
                // config entries are reflected exactly (import is the source
                // of truth until the cutover; admin-made edits after cutover
                // never go through this command again).
                $product->colors()->delete();
                foreach (array_values($p['colors']) as $i => $c) {
                    $product->colors()->create([
                        'name'       => $c['name'],
                        'slug'       => $c['slug'],
                        'hex'        => $c['hex'],
                        'image_path' => $c['image'],
                        'sort_order' => $i,
                    ]);
                }

                $tagIds = Tag::whereIn('key', $p['tags'] ?? [])->pluck('id', 'key');
                $product->tags()->sync($tagIds->values()->all());
            });
        }

        if (! $dryRun) {
            $this->info('Products imported: '.Product::count().' rows, '.
                \App\Models\ProductColor::count().' colors, '.
                DB::table('product_tag')->count().' tag assignments.');
        }
    }
}
