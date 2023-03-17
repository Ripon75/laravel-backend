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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('area_id')->constrained('areas')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('title', 50)->nullable();
            $table->string('phone_number', 50)->nullable();
            $table->string('line_one', 100)->nullable();
            $table->string('line_two', 100)->nullable();
            $table->string('post_code', 10)->nullable();
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
        Schema::dropIfExists('addresses');
    }
};
