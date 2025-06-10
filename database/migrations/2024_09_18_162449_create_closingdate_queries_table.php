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
        Schema::create('closingdate_queries', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('post_id');
            $table->integer('agent_id');
            $table->integer('sellerorbuyer_id');
            $table->integer('sellerorbuyer_role');
            $table->integer('agent_role');
            $table->string('select_date');
            $table->integer('status')->default(1)->comment('0="De-active",1="Active"');
            $table->string('closing_date')->nullable();
            $table->mediumText('comments')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('closingdate_queries');
    }
};
