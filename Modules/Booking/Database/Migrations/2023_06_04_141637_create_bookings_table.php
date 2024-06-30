<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id')->unique();
            $table->unsignedBigInteger('balance_tranction_id')->nullable();
            $table->unsignedBigInteger('show_id');
            $table->date('booking_for', 8, 2);
            $table->decimal('total', 8, 2);
            $table->decimal('gst', 8, 2);
            $table->decimal('net_total', 8, 2);
            $table->unsignedBigInteger('booking_by');
            $table->string('mobile')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('balance_tranction_id')->references('id')->on('balance_transactions');
            $table->foreign('booking_by')->references('id')->on('users');
            $table->foreign('show_id')->references('id')->on('shows');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
