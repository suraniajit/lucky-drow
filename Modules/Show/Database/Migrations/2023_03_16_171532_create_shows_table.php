<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Show\Entities\Show;

class CreateShowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $show = new Show();
        Schema::create('shows', function (Blueprint $table) use($show) {
            $table->id();
            $table->string('show_name');
            $table->time('show_time');
            $table->json('show_day');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status',array_keys($show->allStatus()));
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shows');
    }
}
