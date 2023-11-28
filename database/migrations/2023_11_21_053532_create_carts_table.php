<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengelola_id');
            $table->foreignId('produk_id');
            $table->foreignId('customer_id');
            $table->string('foto');
            $table->string('kode_produk')->unique();
            $table->string('harga');
            $table->string('qty');
            $table->string('total');
            $table->string('pajak');
            $table->string('status');
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
        Schema::dropIfExists('carts');
    }
}
