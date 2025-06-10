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
        Schema::create('agents_question', function (Blueprint $table) {
            $table->integer('question_id', true);
            $table->longText('question');
            $table->integer('add_by')->comment('id');
            $table->integer('add_by_role')->comment('role id');
            $table->enum('question_type', ['1', '2', '3', '4', '5'])->comment('1=admin,2=Buyer,3=seller,4=Agent,5=New User');
            $table->enum('importance', ['0', '1'])->default('0')->comment('0=no,1=yes');
            $table->enum('survey', ['0', '1'])->default('0')->comment('0=no,1=yes');
            $table->enum('is_deleted', ['0', '1'])->default('0');
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
        Schema::dropIfExists('agents_question');
    }
};
