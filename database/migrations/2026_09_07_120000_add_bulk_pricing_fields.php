<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('items_subtotal', 10, 2)->default(0)->after('shipping_address');
            $table->decimal('setup_fees_total', 10, 2)->default(0)->after('items_subtotal');
            $table->decimal('shipping_total', 10, 2)->default(0)->after('setup_fees_total');
            $table->json('pricing_breakdown')->nullable()->after('shipping_total');
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->string('decoration')->default('none')->after('color_name');
            $table->string('decoration_label')->nullable()->after('decoration');
            $table->decimal('unit_price', 10, 2)->default(0)->after('decoration_label');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['items_subtotal', 'setup_fees_total', 'shipping_total', 'pricing_breakdown']);
        });
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn(['decoration', 'decoration_label', 'unit_price']);
        });
    }
};
