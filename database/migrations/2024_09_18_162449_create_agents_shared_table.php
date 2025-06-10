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
        Schema::create('agents_shared', function (Blueprint $table) {
            $table->integer('shared_id', true);
            $table->enum('shared_type', ['1', '2', '3', '4'])->comment('1=ask_question,2=upload and share,3=default proposal,4=no value');
            $table->integer('shared_item_id');
            $table->enum('shared_item_type', ['1', '2'])->comment('1=post,2=agents');
            $table->string('shared_item_type_id', 11);
            $table->integer('sender_id');
            $table->integer('sender_role');
            $table->integer('receiver_id');
            $table->integer('receiver_role');
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
        Schema::dropIfExists('agents_shared');
    }
};
