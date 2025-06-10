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
        Schema::create('agents_blog', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('title')->nullable();
            $table->integer('cat_id')->nullable();
            $table->longText('description')->nullable();
            $table->timestamp('created_date')->useCurrent();
            $table->integer('status')->nullable();
            $table->integer('view')->nullable();
            $table->string('viewer_id')->nullable();
            $table->integer('added_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agents_blog');
    }
};
