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
        Schema::create('agents_conversation', function (Blueprint $table) {
            $table->integer('conversation_id', true);
            $table->integer('post_id');
            $table->integer('sender_id');
            $table->integer('sender_role_id');
            $table->integer('receiver_id');
            $table->integer('receiver_role_id');
            $table->enum('tags_read', ['1', '2'])->default('1')->comment('1=unread,2=read');
            $table->integer('tags_user_id')->default(0);
            $table->integer('tags_user_role');
            $table->mediumText('last_sender_msg')->nullable();
            $table->timestamp('last_sender_da')->useCurrent();
            $table->mediumText('last_receiver_msg')->nullable();
            $table->timestamp('last_receiver_da')->useCurrent();
            $table->mediumText('snippet')->nullable();
            $table->integer('unread_count')->default(0);
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
        Schema::dropIfExists('agents_conversation');
    }
};
