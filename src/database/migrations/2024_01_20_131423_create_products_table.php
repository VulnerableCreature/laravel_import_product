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
        Schema::create('products', function (Blueprint $table) {
            $table->id()->comment("ID продукта");
            $table->text('name')->nullable()->comment("Название товара");
            $table->text('price')->nullable()->comment("Цена товара");
            $table->text('discount')->nullable()->comment("Скидка на товар");
            $table->text('description')->nullable()->comment("Описание товара [необязательно]");
            $table->string('type')->nullable()->comment("Тип товара");
            $table->string('external_code', 130)->comment("Внешний код продукта");
            /* -------------------------------------Штрихкод------------------- */
            $table->integer('barcode_ean_thirteen')->nullable()->comment("Штрихкод EAN13 integer");
            $table->string('barcode_ean_eight', 150)->nullable()->comment("Штрихкод EAN8 string");
            $table->text('barcode_code')->nullable()->comment("Штрихкод Code128 text");
            $table->text('barcode_ean_upc')->nullable()->comment("Штрихкод UPC text");
            $table->text('barcode_ean_gtin')->nullable()->comment("Штрихкод GTIN text");
            /* ------------------------------------------------------------------- */
            $table->string('additional_features')->nullable()->comment("Дополнительные характеристики товара");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
