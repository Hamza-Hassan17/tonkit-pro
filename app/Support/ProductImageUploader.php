<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;

/**
 * Deliberately minimal image handling for the admin panel -- v1 does NOT
 * attempt automated background removal (that GD flood-fill pipeline caused
 * two separate production bugs this session: alphablending left on during
 * the fill write made "transparent" pixels silently no-op, and later,
 * alphablending on during the resize copy flattened pre-existing
 * transparency into opaque black). Admin uploads an already-prepared image;
 * this class only resizes it to the catalog's standard width, preserving
 * whatever alpha channel the source already has.
 */
class ProductImageUploader
{
    const TARGET_WIDTH = 1100;

    /**
     * Resize $file to 1100px wide (preserving aspect ratio + alpha) and
     * save it to public/images/products/<slug>/<colorSlug>.png, replacing
     * any existing file for that color. Returns the stored relative path
     * (e.g. "images/products/a-town/navy.png").
     */
    public static function store(UploadedFile $file, string $productSlug, string $colorSlug): string
    {
        $relativePath = "images/products/{$productSlug}/{$colorSlug}.png";
        $absolutePath = public_path($relativePath);

        @mkdir(dirname($absolutePath), 0777, true);

        $ext = strtolower($file->getClientOriginalExtension());
        $src = match ($ext) {
            'png'          => imagecreatefrompng($file->getRealPath()),
            'jpg', 'jpeg'  => imagecreatefromjpeg($file->getRealPath()),
            'webp'         => imagecreatefromwebp($file->getRealPath()),
            default        => throw new \InvalidArgumentException("Unsupported image type: {$ext}"),
        };

        $w = imagesx($src);
        $h = imagesy($src);
        $targetW = min(self::TARGET_WIDTH, $w); // never upscale
        $targetH = (int) round($h * $targetW / $w);

        $out = imagecreatetruecolor($targetW, $targetH);

        // Preserve the source's own alpha channel (if any) without
        // blending it against anything -- this is the exact fix for both
        // prior bugs: alphablending must be off for a straight alpha-
        // preserving copy, not left at its default "on".
        imagealphablending($src, false);
        imagesavealpha($src, true);
        imagealphablending($out, false);
        imagesavealpha($out, true);

        imagecopyresampled($out, $src, 0, 0, 0, 0, $targetW, $targetH, $w, $h);
        imagedestroy($src);

        imagepng($out, $absolutePath, 6);
        imagedestroy($out);

        return $relativePath;
    }

    /** Delete a color's image file from disk, if it exists. */
    public static function delete(?string $relativePath): void
    {
        if (! $relativePath) {
            return;
        }

        $absolute = public_path($relativePath);
        if (is_file($absolute)) {
            @unlink($absolute);
        }
    }
}
