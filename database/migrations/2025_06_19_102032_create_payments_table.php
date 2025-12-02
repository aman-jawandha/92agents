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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('payment_status')->nullable();
            $table->float('amount')->nullable();
            $table->string('payment_for')->nullable();
            $table->string('plan_type')->nullable();
            $table->string('payment_by')->nullable();
            $table->integer('user_role')->nullable();
            $table->boolean('is_recurring')->default(false);
            $table->string('billing_cycle')->nullable();
            $table->string('stripe_subscription_id')->nullable();
            $table->string('stripe_invoice_id')->nullable();
            $table->date('cycle_start')->nullable();
            $table->date('cycle_end')->nullable();
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
        Schema::dropIfExists('payments');
    }
};
