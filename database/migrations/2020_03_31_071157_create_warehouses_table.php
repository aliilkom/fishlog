<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('nama');
            $table->string('hp')->nullable();
            $table->string('lokasi')->nullable();
            $table->integer('ruang')->nullable();
            $table->integer('kapasitas')->nullable();
            // $table->integer('bysewa')->nullable();
            // $table->integer('bybongkar')->nullable();
            // $table->integer('bymuat')->nullable();
            $table->string('image')->default('/upload/gudang/fishlog.jpg');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouses');
    }
}
