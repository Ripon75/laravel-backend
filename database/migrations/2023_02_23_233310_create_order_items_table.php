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
        Schema::create('order_items', function (Blueprint $table) {
            $table->foreignId('order_id')->constrained('orders')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('item_id')->constrained('products')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedInteger('quantity')->default(1);
            $table->decimal('price', 20, 2);
            $table->decimal('promo_price', 20, 2)->default(0);
            $table->foreignId('size_id')->constrained('sizes')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('color_id')->constrained('colors')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();

            $table->primary(['order_id', 'item_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};
