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
        Schema::create('agents_advertise', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('package_id');
            $table->integer('agent_id');
            $table->integer('ad_place');
            $table->longText('receipt_url');
            $table->string('ad_title', 40);
            $table->string('ad_link', 500);
            $table->string('ad_banner', 100)->nullable();
            $table->string('ad_content', 1000)->nullable();
            $table->integer('clicks');
            $table->timestamp('created_ts')->useCurrent();
            $table->dateTime('updated_ts');
            $table->boolean('status')->default(false);
            $table->boolean('deleted')->default(false);
            $table->integer('payment_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agents_advertise');
    }
};
