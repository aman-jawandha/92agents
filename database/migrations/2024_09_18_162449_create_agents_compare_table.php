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
        Schema::create('agents_compare', function (Blueprint $table) {
            $table->integer('compare_id');
            $table->mediumText('compare_item_id')->comment('agents id');
            $table->integer('post_id');
            $table->integer('sender_id');
            $table->integer('sender_role');
            $table->mediumText('compare_json')->nullable();
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
        Schema::dropIfExists('agents_compare');
    }
};
