<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BalanceLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()


    {
        Schema::create('balance_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->unique();
            $table->unsignedBigInteger('user_id');
            $table->enum('type',['withdrawal ','deposit']);
            $table->decimal('amount', 8, 2);
            $table->enum('status',['pending','success','fail'])->default('pending');
            $table->string('otp')->nullable();
            $table->string('remark')->nullable();
            $table->decimal('before_amount', 8, 2)->nullable();
            $table->decimal('after_amount', 8, 2)->nullable();
            $table->unsignedBigInteger('create_by');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('create_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('balance_transactions');
    }
}
