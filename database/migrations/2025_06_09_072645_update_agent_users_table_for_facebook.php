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
        Schema::table('agent_users', function (Blueprint $table) {
            // Add facebook_id (nullable and unique)
            $table->string('facebook_id')->nullable()->unique();

            // Make password column nullable
            $table->string('password')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agent_users', function (Blueprint $table) {
            $table->dropColumn('facebook_id');

            // Revert password column to NOT NULL (you can adjust if needed)
            $table->string('password')->nullable(false)->change();
        });
    }
};
