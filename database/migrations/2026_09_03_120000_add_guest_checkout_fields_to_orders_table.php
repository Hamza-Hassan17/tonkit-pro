<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->change();

            $table->string('customer_name')->nullable()->after('user_id');
            $table->string('customer_email')->nullable()->after('customer_name');
            $table->string('customer_phone')->nullable()->after('customer_email');
            $table->text('shipping_address')->nullable()->after('customer_phone');

            $table->string('payment_method')->default('stripe')->after('status');
            $table->string('stripe_session_id')->nullable()->after('paypal_txn_id');
            $table->string('stripe_payment_intent')->nullable()->after('stripe_session_id');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'customer_name', 'customer_email', 'customer_phone', 'shipping_address',
                'payment_method', 'stripe_session_id', 'stripe_payment_intent',
            ]);
        });
    }
};
