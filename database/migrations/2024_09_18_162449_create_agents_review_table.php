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
        Schema::create('agents_review', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('agent_id')->nullable();
            $table->integer('sender_id')->nullable();
            $table->integer('star')->nullable();
            $table->timestamp('created_date')->nullable()->useCurrent();
            $table->string('comment', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agents_review');
    }
};
