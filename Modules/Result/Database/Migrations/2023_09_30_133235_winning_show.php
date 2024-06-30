<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WinningShow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('winning_shows', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sysmbol_id');
            $table->unsignedBigInteger('show_id');
            $table->date('drow_date');
            $table->decimal('total_winning_price',8,2);
            $table->integer('collected_amount');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('sysmbol_id')->references('id')->on('symboles');
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
        //
    }
}
