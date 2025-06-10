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
        Schema::create('agents_franchise', function (Blueprint $table) {
            $table->integer('franchise_id', true);
            $table->string('franchise_name', 250)->nullable();
            $table->enum('is_deleted', ['0', '1'])->default('0')->comment('0=no,1=yes');
            $table->integer('status')->default(1)->comment('0="De-active", 1="active"');
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
        Schema::dropIfExists('agents_franchise');
    }
};
