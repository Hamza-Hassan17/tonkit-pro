<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('province')->nullable()->after('shipping_address');
            $table->decimal('gst_total', 10, 2)->default(0)->after('discount_total');
            $table->decimal('qst_total', 10, 2)->default(0)->after('gst_total');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['province', 'gst_total', 'qst_total']);
        });
    }
};
