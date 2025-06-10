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
        Schema::create('agents_city', function (Blueprint $table) {
            $table->integer('city_id', true);
            $table->string('city_name', 50)->nullable();
            $table->integer('state_id')->nullable();
            $table->enum('is_deleted', ['0', '1'])->comment('0=no,1=yes');
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
        Schema::dropIfExists('agents_city');
    }
};
