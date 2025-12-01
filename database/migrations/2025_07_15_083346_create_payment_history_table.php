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
        Schema::create('payment_history', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('payment_status')->nullable();
            $table->float('amount')->nullable();
            $table->string('payment_for')->nullable();
            $table->string('plan_type')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('duration');
            $table->string('designs');
            $table->string('no_of_popins');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_history');
    }
};
