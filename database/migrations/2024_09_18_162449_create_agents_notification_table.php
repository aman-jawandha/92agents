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
        Schema::create('agents_notification', function (Blueprint $table) {
            $table->integer('notification_id', true);
            $table->enum('notification_type', ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16'])->comment('1=agent share ask question,2=agent share upload and share,3=agent share default proposal,4=b/s  share ask question,5=b/s share upload and share,6=join messaging and chating,7=send new msg,8=answer rating,9=message rating,10=asked question return answer any user,11=new s/a/b send connection ->notification_item_id is m connection_id rahe gi or ->notification_child_item_id is me post ki id rahe gi 12 = b/s ke conected user ko new post add hoti h to notification jaye ga ki es buyer n new post ki h ,13=post applied agents selecte, 14=buyer/seller give a reviwe or rating for agent ye notification agent ko dikhe ga , 15=agent give a reviwe or rating for buyer/seller post  ko ye notification  buyer/seller ko dikhe ga ,16=agent payment done thene give a rating s/b post pr ');
            $table->string('notification_message', 1000)->nullable();
            $table->integer('notification_item_id')->nullable();
            $table->integer('notification_child_item_id')->nullable();
            $table->integer('notification_post_id')->nullable();
            $table->enum('status', ['1', '2'])->default('1')->comment('1=unread,2=read');
            $table->integer('sender_id')->nullable();
            $table->integer('sender_role')->nullable();
            $table->integer('receiver_id')->nullable();
            $table->integer('receiver_role')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
            $table->enum('show', ['1', '2'])->default('1')->comment('1=show,2=hide');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agents_notification');
    }
};
