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
        Schema::create('agents_bookmark', function (Blueprint $table) {
            $table->integer('bookmark_id', true);
            $table->enum('bookmark_type', ['1', '2', '3', '4', '5'])->comment('1=\'question\',2=\'sz/bz/az \',3=\'message\',4=\'answers\',5=\'proposal\'');
            $table->integer('bookmark_item_id')->nullable();
            $table->integer('bookmark_item_parent_id')->nullable();
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
        Schema::dropIfExists('agents_bookmark');
    }
};
