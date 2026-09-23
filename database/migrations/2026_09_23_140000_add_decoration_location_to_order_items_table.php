<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->string('decoration_location')->nullable()->after('decoration_label');
            $table->string('decoration_location_label')->nullable()->after('decoration_location');
        });
    }

    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn(['decoration_location', 'decoration_location_label']);
        });
    }
};
