<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengelola_id');
            $table->foreignId('produk_id');
            $table->foreignId('customer_id');
            $table->string('kode_produk')->unique();
            $table->string('kode_transaksi')->unique();
            $table->string('tgl_transaksi');
            $table->string('harga');
            $table->string('qty');
            $table->string('total');
            $table->string('pajak');
            $table->string('payment_method');
            $table->enum('payment_status', ['Process', 'Success', 'Expired']);
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
        Schema::dropIfExists('transaksis');
    }
}
