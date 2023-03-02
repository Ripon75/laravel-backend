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
            $table->foreignId('address_id')->constrained('addresses')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('pg_id')->nullable()->constrained('payment_gateways')
                ->onUpdate('cascade')->onDelete('cascade')->comment('Payment gateway');
            $table->foreignId('current_status_id')->nullable()->constrained('statuses')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('current_status_at')->nullable();
            $table->decimal('delivery_charge', 8, 2)->default(0);
            $table->decimal('order_value', 8, 2)->default(0);
            $table->decimal('order_discount', 8, 2)->default(0);
            $table->boolean('is_paid')->default(false);
            $table->timestamp('paid_at')->nullable();
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
