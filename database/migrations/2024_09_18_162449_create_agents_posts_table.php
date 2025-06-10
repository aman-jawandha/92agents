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
        Schema::create('agents_posts', function (Blueprint $table) {
            $table->integer('post_id', true);
            $table->integer('agents_user_id');
            $table->integer('agents_users_role_id');
            $table->mediumText('posttitle')->nullable();
            $table->longText('details')->nullable()->comment('buyer,seller');
            $table->string('address1', 100)->nullable()->comment('seller');
            $table->string('address2', 100)->nullable()->comment('seller');
            $table->integer('city')->nullable()->comment('buyer,seller');
            $table->integer('state')->nullable()->default(0)->comment('buyer,seller');
            $table->integer('status')->default(1);
            $table->string('area', 250)->nullable()->comment('buyer');
            $table->string('zip', 100)->nullable()->comment('seller');
            $table->string('when_do_you_want_to_sell', 50)->nullable()->comment('buyer,seller, = now , within 30days , within 90 days , undecided');
            $table->enum('need_Cash_back', ['0', '1'])->nullable()->comment('buyer,seller 0=no,1=yes');
            $table->enum('interested_short_sale', ['0', '1'])->nullable()->comment('seller 0=no,1=yes');
            $table->enum('got_lender_approval_for_short_sale', ['0', '1'])->nullable()->comment('seller 0=no,1=yes');
            $table->string('home_type', 50)->nullable()->comment('buyer,seller Single Family,    Condo/Townhome,    Multi Family,    Manufactured,    Lots/Land');
            $table->longText('best_features')->nullable()->comment('seller');
            $table->string('price_range', 50)->nullable()->comment('buyer');
            $table->integer('firsttime_home_buyer')->nullable()->comment('buyer');
            $table->integer('do_u_have_a_home_to_sell')->nullable()->comment('buyer');
            $table->integer('if_so_do_you_need_help_selling')->nullable()->comment('buyer');
            $table->integer('interested_in_buying')->nullable()->comment('buyer');
            $table->string('bids_emailed', 50)->nullable()->comment('buyer');
            $table->string('do_you_need_financing', 50)->nullable()->comment('buyer');
            $table->enum('is_deleted', ['0', '1'])->nullable()->default('0')->comment('0=no,1=yes');
            $table->enum('applied_post', ['1', '2'])->default('2')->comment('1=yes,2=no');
            $table->integer('applied_user_id')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->integer('post_type')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('agent_select_date')->nullable();
            $table->enum('agent_send_review', ['1', '2'])->default('2');
            $table->enum('buyer_seller_send_review', ['1', '2'])->default('2');
            $table->enum('mark_complete', ['1', '2'])->default('2');
            $table->dateTime('closing_date')->nullable();
            $table->string('agent_payment', 50)->nullable();
            $table->integer('final_status')->default(0)->comment('0="Pending", 1="in-progress",2="closed"');
            $table->string('cron_time', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agents_posts');
    }
};
