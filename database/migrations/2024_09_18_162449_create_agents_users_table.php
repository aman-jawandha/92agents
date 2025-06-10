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
        Schema::create('agents_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('password');
            $table->rememberToken();
            $table->string('activation_link', 100)->nullable();
            $table->string('forgot_token', 100)->nullable();
            $table->enum('agents_users_role_id', ['1', '2', '3', '4', '5', '6']);
            $table->enum('agent_status', ['1', '0', '2', '3'])->default('0')->comment('0=no,1=yes, 2=Temp Suspension for closing date,3=Permanent Suspension for closing date');
            $table->enum('step', ['0', '1', '2', '3'])->comment('step level');
            $table->enum('language', ['en', 'dk'])->default('en');
            $table->enum('status', ['0', '1'])->default('0')->comment('1 = active, 0= deactive');
            $table->enum('first_login', ['1', '2'])->default('1')->comment('1=yes,2=no');
            $table->string('login_status', 11)->default('online');
            $table->string('api_token', 250)->default(' ');
            $table->enum('is_deleted', ['0', '1'])->default('0')->comment('0 = no, 1= yes');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->string('card_number', 250)->nullable();
            $table->string('name_on_card', 250)->nullable();
            $table->string('cvc', 250)->nullable();
            $table->string('card_expiry_year', 250)->nullable();
            $table->string('customer_id', 250)->nullable();
            $table->string('card_expiry_month', 250)->nullable();
            $table->string('package', 45)->nullable();
            $table->mediumText('fcm_token')->nullable();
            $table->string('device_type', 24)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agents_users');
    }
};
