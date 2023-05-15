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
        Schema::create('homestays', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("pemilik_id");
            $table->string("gambar");
            $table->string("nama");
            $table->string("alamat");
            $table->bigInteger("harga");
            $table->integer("rating");
            $table->string("status");

            $table->foreign("pemilik_id")->on("admins")->references("id");
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
        Schema::dropIfExists('homestays');
    }
};
