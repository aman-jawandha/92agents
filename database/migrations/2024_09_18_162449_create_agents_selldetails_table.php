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
        Schema::create('agents_selldetails', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('sellers_name', 100);
            $table->string('address', 250)->nullable();
            $table->dateTime('sale_date')->nullable();
            $table->float('sale_price', 10)->nullable();
            $table->integer('post_id');
            $table->integer('agent_id');
            $table->integer('agent_comission')->default(3);
            $table->integer('comission_92agent')->default(3);
            $table->boolean('payment_status')->nullable()->default(false);
            $table->integer('payment_id')->nullable();
            $table->string('receipt_url', 300)->nullable();
            $table->timestamp('created_ts')->useCurrent();
            $table->timestamp('updated_ts')->useCurrent();
            $table->boolean('status')->default(true);
            $table->boolean('deleted')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agents_selldetails');
    }
};
