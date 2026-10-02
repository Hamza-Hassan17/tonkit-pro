<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_colors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug');
            $table->string('hex', 7);
            $table->string('image_path');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            // Unique within a product, not globally -- two products can both have "navy".
            $table->unique(['product_id', 'slug']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_colors');
    }
};
