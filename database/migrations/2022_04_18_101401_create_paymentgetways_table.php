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
        Schema::create('paymentgetways', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('loanName');
            $table->string('paymentNumber');
            $table->string('paymentAmount');
            $table->string('paymentdate');
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
        Schema::dropIfExists('paymentgetways');
    }
};
