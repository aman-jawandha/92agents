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
        Schema::create('agents_users_roles', function (Blueprint $table) {
            $table->integer('role_id');
            $table->string('role_name');
            $table->enum('status', ['0', '1'])->default('1')->comment('1 = active, 0= deactive');
            $table->enum('is_deleted', ['0', '1'])->default('0')->comment('0 = no, 1= yes');
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
        Schema::dropIfExists('agents_users_roles');
    }
};
