<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNationalDirectorFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('national_director_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('ndf_your_company_name')->nullable();
            $table->text('ndf_company_organized')->nullable();
            $table->text('ndf_your_company_address')->nullable();
            $table->text('ndf_licensee_company_name')->nullable();
            $table->text('ndf_licensee_designation')->nullable();
            $table->text('ndf_licensee_date')->nullable();
            $table->text('ndf_licensee_signature')->nullable();
            $table->text('ndf_licensee_name')->nullable();
            $table->text('ndf_licensee_surname')->nullable();
            $table->text('ndf_licensee_passport_number')->nullable();
            $table->text('ndf_licensee_gender')->nullable();
            $table->text('ndf_licensee_phone')->nullable();
            $table->text('ndf_licensee_email')->nullable();
            $table->text('ndf_licensee_facebook')->nullable();
            $table->text('ndf_licensee_incumbebt_post')->nullable();
            $table->text('ndf_licensee_company_phone')->nullable();
            $table->text('ndf_licensee_present_address')->nullable();
            $table->text('ndf_licensee_company_address')->nullable();
            $table->text('ndf_licensee_mother_tongue')->nullable();
            $table->text('ndf_licensee_english_level')->nullable();
            $table->text('ndf_licensee_other_foreign_languages')->nullable();
            $table->text('ndf_licensee_company_introduction')->nullable();
            $table->text('ndf_licensee_your_advantages')->nullable();
            $table->text('ndf_licensee_mci')->nullable();
            $table->text('ndf_licensee_full_name')->nullable();
            $table->text('ndf_licensee_contact_number')->nullable();
            $table->text('ndf_licensee_relationship')->nullable();
            $table->text('ndf_licensee_email_2')->nullable();
            $table->text('ndf_licensee_contact_address')->nullable();
            $table->text('ndf_general_contact_name')->nullable();
            $table->text('ndf_general_contact_title')->nullable();
            $table->text('ndf_general_contact_tel')->nullable();
            $table->text('ndf_general_contact_mobile')->nullable();
            $table->text('ndf_general_contact_email')->nullable();
            $table->text('ndf_develop_team_contact_email')->nullable();
            $table->text('ndf_develop_team_contact_name')->nullable();
            $table->text('ndf_develop_team_contact_tel')->nullable();
            $table->text('ndf_develop_team_contact_mobile')->nullable();
            $table->text('ndf_develop_team_contact_email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('national_director_forms');
    }
}
