<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('warehouse_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('merk_id')->unsigned();

            $table->string('nama');
            $table->string('sku')->nullable();
            $table->integer('jumlah')->nullable();
            $table->integer('jumlahsrent')->nullable();
            $table->integer('tagihan')->nullable();
            $table->string('satuan');
            $table->string('spesifikasi')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();

            $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('merk_id')->references('id')->on('merks')->onDelete('cascade');


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
}
