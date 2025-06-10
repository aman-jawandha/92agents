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
        Schema::create('agents_conversation_message', function (Blueprint $table) {
            $table->integer('messages_id', true);
            $table->integer('conversation_id');
            $table->integer('post_id')->default(0);
            $table->integer('sender_id');
            $table->integer('sender_role');
            $table->integer('receiver_id');
            $table->integer('receiver_role');
            $table->longText('message_text')->nullable();
            $table->enum('tags_read', ['1', '2'])->default('1')->comment('1=unread,2=read');
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
        Schema::dropIfExists('agents_conversation_message');
    }
};
