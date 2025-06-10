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
        Schema::create('agents_blog_comment', function (Blueprint $table) {
            $table->integer('com_id');
            $table->string('blog_id', 45);
            $table->string('comment_name', 100);
            $table->string('email', 100)->nullable();
            $table->string('comment');
            $table->timestamp('com_date')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agents_blog_comment');
    }
};
