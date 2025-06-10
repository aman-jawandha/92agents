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
        Schema::create('agents_importance', function (Blueprint $table) {
            $table->integer('importance_id', true);
            $table->integer('agents_user_id')->nullable();
            $table->integer('agents_users_role_id')->nullable();
            $table->integer('importance_item_id')->nullable();
            $table->enum('importance_type', ['1'])->comment('1=question');
            $table->enum('is_deleted', ['0', '1'])->default('0')->comment('0=no,1=yes');
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
        Schema::dropIfExists('agents_importance');
    }
};
