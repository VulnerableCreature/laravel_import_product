<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('characteristics', function (Blueprint $table) {
            $table->id();
            /*-----------------Foreign key---------------*/
            $table->integer('product_id')->comment("Внешний ключ для связи с таблицей products");
            $table->index('product_id', 'product_characteristic_idx');
            $table->foreign('product_id', 'product_characteristic_fk')->references('product_id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            /*-------------------------------------------*/
            $table->string('key')->comment("Ключ характеристики");
            $table->string('value')->comment("Значение характеристики");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characteristics');
    }
};
