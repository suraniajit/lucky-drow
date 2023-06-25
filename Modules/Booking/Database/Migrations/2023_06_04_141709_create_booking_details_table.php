<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('sysmbol_id');
            $table->string('price');                //each tiket price
            $table->integer('book');                 //no of tiket booking
            $table->decimal('total_price',8,2);          // total price 
            $table->decimal('gst',8,2);                  // total gst amount
            $table->decimal('net_total',8,2);            //  net total
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('booking_id')->references('id')->on('bookings');
            $table->foreign('sysmbol_id')->references('id')->on('symboles');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_details');
    }
}
