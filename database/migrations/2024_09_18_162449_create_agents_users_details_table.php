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
        Schema::create('agents_users_details', function (Blueprint $table) {
            $table->integer('details_id', true);
            $table->string('name')->nullable();
            $table->string('fname', 32)->nullable();
            $table->string('lname', 32)->nullable();
            $table->mediumText('address')->nullable();
            $table->string('address2', 100)->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_home', 20)->nullable();
            $table->string('phone_work', 20)->nullable();
            $table->string('state_id', 11)->nullable();
            $table->mediumText('city_id')->nullable();
            $table->string('area', 11)->nullable();
            $table->string('fax_no', 50)->nullable();
            $table->string('zip_code', 250)->nullable();
            $table->longText('description')->nullable();
            $table->string('photo')->nullable();
            $table->string('company')->nullable();
            $table->string('website')->nullable();
            $table->longText('education')->nullable();
            $table->longText('employment')->nullable();
            $table->string('skills')->nullable();
            $table->string('licence_number')->nullable();
            $table->string('state_licence', 30)->nullable();
            $table->longText('default_proposals')->nullable();
            $table->integer('question_1')->nullable();
            $table->string('answer_1', 250)->nullable();
            $table->integer('question_2')->nullable();
            $table->string('answer_2', 250)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->string('franchise', 250)->nullable();
            $table->string('other_franchise', 50)->nullable();
            $table->string('company_name', 50)->nullable();
            $table->string('years_of_expreience', 50)->nullable();
            $table->string('office_address', 50)->nullable();
            $table->string('brokers_name', 50)->nullable();
            $table->string('MLS_public_id', 50)->nullable();
            $table->string('MLS_office_id', 50)->nullable();
            $table->longText('real_estate_education')->nullable();
            $table->string('certifications', 250)->nullable();
            $table->longText('industry_experience')->nullable();
            $table->string('specialization', 250)->nullable();
            $table->enum('show_individual_yearly_figures', ['0', '1'])->nullable()->default('0')->comment('1=yes,0=no');
            $table->longText('sales_history')->nullable();
            $table->integer('total_sales')->default(0);
            $table->string('associations_awards', 250)->nullable();
            $table->string('publications', 250)->nullable();
            $table->string('community_involvement', 250)->nullable();
            $table->longText('language_proficiency')->nullable();
            $table->string('additional_details', 1000)->nullable();
            $table->string('when_u_want_to_buy', 50)->nullable();
            $table->string('price_range', 50)->nullable();
            $table->string('property_type', 50)->nullable();
            $table->integer('firsttime_home_buyer')->nullable();
            $table->longText('specific_requirements')->nullable();
            $table->integer('do_u_have_a_home_to_sell')->nullable();
            $table->integer('if_so_do_you_need_help_selling')->nullable();
            $table->integer('interested_buying')->nullable()->comment('buyer,seller');
            $table->integer('got_lender_approval_for_short_sale')->default(0)->comment('seller');
            $table->string('bids_emailed', 50)->nullable();
            $table->string('do_you_need_financing', 50)->nullable();
            $table->integer('need_Cash_back')->nullable()->comment('buyer,seller');
            $table->integer('terms_and_conditions')->default(0);
            $table->string('statement_document', 250)->nullable();
            $table->string('agent_rating', 50)->nullable();
            $table->string('buyer_rating', 50)->nullable();
            $table->string('seller_rating', 50)->nullable();
            $table->integer('contract_verification')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agents_users_details');
    }
};
