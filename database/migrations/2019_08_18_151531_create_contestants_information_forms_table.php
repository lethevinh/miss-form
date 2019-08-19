<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContestantsInformationFormsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('contestants_information_forms', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->text('cif_country')->nullable();
			$table->text('cif_family_name')->nullable();
			$table->text('cif_first_name')->nullable();
			$table->text('cif_address')->nullable();
			$table->text('cif_daytime_tel_no')->nullable();
			$table->text('cif_evening_tel_no')->nullable();
			$table->text('cif_father_full_name')->nullable();
			$table->text('cif_father_occupation')->nullable();
			$table->text('cif_mother_full_name')->nullable();
			$table->text('cif_mother_occupation')->nullable();
			$table->text('cif_your_age')->nullable();
			$table->text('cif_birth_day')->nullable();
			$table->text('cif_passport_number')->nullable();
			$table->text('cif_passport_place_of_issue')->nullable();
			$table->text('cif_date_of_issue')->nullable();
			$table->text('cif_expity_date')->nullable();
			$table->text('cif_curren_occupation')->nullable();
			$table->text('cif_education')->nullable();
			$table->text('cif_your_title')->nullable();
			$table->text('cif_link_facebook')->nullable();
			$table->text('cif_link_instagram')->nullable();
			$table->text('cif_blood_group')->nullable();
			$table->text('cif_alergies')->nullable();
			$table->text('cif_name_telephone')->nullable();
			$table->text('cif_passport_image')->nullable();
			$table->text('cif_bust_size')->nullable();
			$table->text('cif_cup_size')->nullable();
			$table->text('cif_waist')->nullable();
			$table->text('cif_hips')->nullable();
			$table->text('cif_shoulders')->nullable();
			$table->text('cif_height')->nullable();
			$table->text('cif_hat_size')->nullable();
			$table->text('cif_dress_size')->nullable();
			$table->text('cif_shoe_size')->nullable();
			$table->text('cif_colour_of_eyes')->nullable();
			$table->text('cif_colour_of_hair')->nullable();
			$table->text('cif_portrait_file')->nullable();
			$table->text('cif_full_long_shot_bikini_file')->nullable();
			$table->text('cif_full_long_shot_evening_gown_file')->nullable();
			$table->text('cif_signature_file')->nullable();
			$table->text('cif_date_signature')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('contestants_information_forms');
	}
}
