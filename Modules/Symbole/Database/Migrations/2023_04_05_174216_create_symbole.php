<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Symbole\Entities\Symbole;

class CreateSymbole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('symboles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('file');
            $table->enum('status',[Symbole::ENABLE , Symbole::DISABLE])->default(Symbole::ENABLE);          
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
        Schema::dropIfExists('symboles');
    }
}
