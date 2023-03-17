<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('address_id')->nullable()->constrained('addresses')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('pg_id')->nullable()->constrained('payment_gateways')
                ->onUpdate('cascade')->onDelete('cascade')->comment('Payment gateway');
            $table->foreignId('coupon_id')->nullable()->constrained('coupons')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('coupon_value', 20, 2)->nullable()->default(0);
            $table->decimal('delivery_charge', 20, 2)->default(0);
            $table->decimal('order_price', 20, 2)->default(0);
            $table->decimal('order_sell_price', 20, 2)->default(0);
            $table->decimal('order_discount', 20, 2)->default(0);
            $table->decimal('order_payable_price', 20, 2)->default(0);
            $table->boolean('is_paid')->default(false);
            $table->timestamp('paid_at')->nullable();
            $table->foreignId('current_status_id')->nullable()->constrained('statuses')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('current_status_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
