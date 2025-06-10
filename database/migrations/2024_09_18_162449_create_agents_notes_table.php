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
        Schema::create('agents_notes', function (Blueprint $table) {
            $table->integer('notes_id', true);
            $table->longText('notes')->nullable();
            $table->enum('notes_type', ['1', '2', '3', '4', '5'])->nullable()->comment('1=messages_notes,2=asked_question_notes,3=return_answer_notes,4=asked proposal  yani ki agar ksine az ne b/s ko propsal share kiya h to buyer/seller unhe note de sakta h,5=s/b/az');
            $table->integer('notes_item_id')->nullable();
            $table->integer('notes_item_parent_id')->nullable();
            $table->integer('sender_id')->nullable();
            $table->integer('sender_role')->nullable();
            $table->integer('receiver_id')->nullable();
            $table->integer('receiver_role')->nullable();
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
        Schema::dropIfExists('agents_notes');
    }
};
