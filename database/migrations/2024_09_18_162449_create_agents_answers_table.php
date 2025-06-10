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
        Schema::create('agents_answers', function (Blueprint $table) {
            $table->integer('answers_id')->nullable();
            $table->string('answers', 500)->nullable();
            $table->integer('question_id')->nullable();
            $table->integer('from_id')->nullable();
            $table->integer('from_role')->nullable();
            $table->enum('is_deleted', ['0', '1'])->default('0');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->integer('post_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agents_answers');
    }
};
