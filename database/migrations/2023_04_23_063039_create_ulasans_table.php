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
        Schema::create('ulasans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("pemesan_id");
            $table->unsignedBigInteger("homestay_id");
            $table->text("ulasan");
            $table->integer("rate");

            $table->foreign("pemesan_id")->on("pemesans")->references("id");
            $table->foreign("homestay_id")->on("homestays")->references("id");
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
        Schema::dropIfExists('ulasans');
    }
};
