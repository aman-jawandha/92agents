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
        Schema::create('agents_users_conections', function (Blueprint $table) {
            $table->integer('connection_id', true);
            $table->integer('post_id');
            $table->integer('to_id');
            $table->integer('to_role');
            $table->integer('from_id');
            $table->integer('from_role');
            $table->dateTime('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->dateTime('closing_date')->nullable();
            $table->enum('post_done', ['1', '2'])->default('2')->comment('1=yes,2=no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agents_users_conections');
    }
};
