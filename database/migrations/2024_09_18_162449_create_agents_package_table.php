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
        Schema::create('agents_package', function (Blueprint $table) {
            $table->integer('package_id');
            $table->string('title', 155);
            $table->longText('details');
            $table->string('package_type', 55);
            $table->float('price', 10);
            $table->enum('type', ['HORIZONTAL', 'SQUARE']);
            $table->boolean('image');
            $table->boolean('content');
            $table->boolean('status')->default(true);
            $table->boolean('deleted')->default(false);
            $table->timestamp('created_ts')->useCurrent();
            $table->timestamp('updated_ts')->default('0000-00-00 00:00:00');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agents_package');
    }
};
