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
        Schema::create('agents_notification_type', function (Blueprint $table) {
            $table->integer('type_id');
            $table->mediumText('title');
            $table->mediumText('slug');
            $table->enum('status', ['0', '1'])->default('0')->comment('0=active,1=inactive');
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->dateTime('updated_at')->nullable()->useCurrent();
            $table->enum('is_deleted', ['0', '1'])->default('0')->comment('1=deleted');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agents_notification_type');
    }
};
