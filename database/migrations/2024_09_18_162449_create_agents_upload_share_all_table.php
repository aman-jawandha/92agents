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
        Schema::create('agents_upload_share_all', function (Blueprint $table) {
            $table->integer('upload_share_id', true);
            $table->integer('agents_user_id');
            $table->integer('agents_users_role_id');
            $table->string('attachments', 100);
            $table->string('name');
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
        Schema::dropIfExists('agents_upload_share_all');
    }
};
