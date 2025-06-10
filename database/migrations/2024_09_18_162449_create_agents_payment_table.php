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
        Schema::create('agents_payment', function (Blueprint $table) {
            $table->integer('payment_id', true);
            $table->decimal('amount', 11);
            $table->decimal('discount', 11);
            $table->decimal('taxes', 11);
            $table->string('payment', 250)->nullable();
            $table->string('post_id', 240)->nullable();
            $table->integer('user_id')->nullable();
            $table->string('stripe_id', 250)->nullable();
            $table->string('transaction_id', 250)->nullable();
            $table->string('stripe_order_no')->nullable();
            $table->string('stripeToken', 250)->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agents_payment');
    }
};
