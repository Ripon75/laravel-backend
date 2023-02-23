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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('status')->default('active');
            $table->decimal('price', 20, 2)->default(0)
                ->comment('Original price');
            $table->decimal('promo_price', 20, 2)->default(0)
                ->comment('Offer price');
            $table->decimal('current_purchase_price', 20, 2)->default(0);
            $table->decimal('avg_purchase_price', 20, 2)->default(0);
            $table->bigInteger('current_stock')->default(0);
            $table->foreignId('category_id')->constrained('categories')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('brand_id')->constrained('brands')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->string('img_src')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->fullText('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
