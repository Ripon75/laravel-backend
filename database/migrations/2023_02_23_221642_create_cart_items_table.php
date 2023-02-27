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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->foreignId('cart_id')->constrained('carts')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('item_id')->constrained('products')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedInteger('quantity')->default(1);
            $table->decimal('price', 20, 2);
            $table->decimal('promo_price', 20, 2)->default(0);
            $table->string('size', 20, 2)->default(0);
            $table->string('color', 20, 2)->default(0);
            $table->foreignId('created_by_id')->nullable()->constrained('users')->onUpdate('cascade')
                ->onDelete('cascade')->comment('Who add this item to cart.');
            $table->timestamps();

            $table->primary(['cart_id', 'item_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
};
