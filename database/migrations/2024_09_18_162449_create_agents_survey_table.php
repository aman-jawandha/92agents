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
        Schema::create('agents_survey', function (Blueprint $table) {
            $table->integer('survey_id', true);
            $table->integer('agents_user_id');
            $table->integer('agents_users_role_id');
            $table->integer('question_id');
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
        Schema::dropIfExists('agents_survey');
    }
};
