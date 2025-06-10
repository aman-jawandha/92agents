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
        Schema::create('agents_employee', function (Blueprint $table) {
            $table->integer('id');
            $table->string('empname', 250);
            $table->string('email', 150);
            $table->string('mobile', 50);
            $table->integer('agentread')->default(0);
            $table->integer('agentchange')->default(0);
            $table->integer('bsread')->default(0);
            $table->integer('bschange')->default(0);
            $table->integer('empread')->default(0);
            $table->integer('empchange')->default(0);
            $table->integer('postlistread')->default(0);
            $table->integer('postlistchange')->default(0);
            $table->integer('badpostread')->default(0);
            $table->integer('badpostchange')->default(0);
            $table->integer('quesread')->default(0);
            $table->integer('queschange')->default(0);
            $table->integer('squesread')->default(0);
            $table->integer('squeschange')->default(0);
            $table->integer('skillread')->default(0);
            $table->integer('skillchange')->default(0);
            $table->integer('franchread')->default(0);
            $table->integer('franchchange')->default(0);
            $table->integer('certificationread')->default(0);
            $table->integer('certificationchange')->default(0);
            $table->integer('stateread')->default(0);
            $table->integer('statechange')->default(0);
            $table->integer('arearead')->default(0);
            $table->integer('areachange')->default(0);
            $table->dateTime('created_at');
            $table->timestamp('updated_ate')->default('0000-00-00 00:00:00');
            $table->integer('status')->default(0);
            $table->string('_token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agents_employee');
    }
};
