<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWinningTiketDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('winning_tiket_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('winning_show_id');
            $table->unsignedBigInteger('booking_id');
            $table->integer('winning_tiket');
            $table->integer('winning_price');
            $table->foreign('winning_show_id')->references('id')->on('winning_shows');
            $table->foreign('booking_id')->references('id')->on('bookings');
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
        Schema::dropIfExists('winning_tiket_details');
    }
}
