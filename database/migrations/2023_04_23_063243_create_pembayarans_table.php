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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("pengirim_id");
            $table->unsignedBigInteger("penerima_id");
            $table->unsignedBigInteger("pesanan_id");
            $table->string("bukti_pembayaran");

            $table->foreign("pengirim_id")->on("banks")->references("id");
            $table->foreign("penerima_id")->on("banks")->references("id");
            $table->foreign("pesanan_id")->on("pesanans")->references("id");
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
        Schema::dropIfExists('pembayarans');
    }
};
