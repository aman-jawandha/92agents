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
        Schema::create('agents_rating', function (Blueprint $table) {
            $table->integer('rating_id');
            $table->string('rating', 11);
            $table->mediumText('review')->nullable();
            $table->enum('rating_type', ['1', '2', '3', '4'])->comment('1=answers,2=messaging,3=agent,4=post');
            $table->integer('rating_item_id');
            $table->integer('rating_item_parent_id');
            $table->integer('sender_id');
            $table->integer('sender_role');
            $table->integer('receiver_id');
            $table->integer('receiver_role');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default('0000-00-00 00:00:00');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agents_rating');
    }
};
