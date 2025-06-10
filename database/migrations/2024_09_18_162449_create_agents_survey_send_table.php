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
        Schema::create('agents_survey_send', function (Blueprint $table) {
            $table->integer('survey_send_id');
            $table->integer('survey_id')->nullable();
            $table->integer('question_id')->nullable();
            $table->integer('agents_user_id')->nullable();
            $table->integer('agents_users_role_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agents_survey_send');
    }
};
