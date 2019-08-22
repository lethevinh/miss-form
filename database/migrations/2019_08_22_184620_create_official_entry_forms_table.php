<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficialEntryFormsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('official_entry_forms', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->text('oef_country')->nullable();
			$table->text('oef_winner_national_fullname')->nullable();
			$table->text('oef_winner_national_country')->nullable();
			$table->text('oef_winner_national_address')->nullable();
			$table->text('oef_licensee_name')->nullable();
			$table->text('oef_licensee_country')->nullable();
			$table->text('oef_licensee_country_laws')->nullable();
			$table->text('oef_licensee_address')->nullable();
			$table->text('oef_licensee_national_country')->nullable();
			$table->text('oef_winner_date')->nullable();
			$table->text('oef_winner_place')->nullable();
			$table->text('oef_winner_signature_file')->nullable();
			$table->text('oef_signed_name')->nullable();
			$table->text('oef_signed_name_and')->nullable();
			$table->text('oef_signed_name_of')->nullable();
			$table->text('oef_signed_signature_file')->nullable();
			$table->text('oef_signed_date')->nullable();
			$table->text('oef_signed_place')->nullable();
			$table->text('oef_witness_name')->nullable();
			$table->text('oef_witness_occupation')->nullable();
			$table->text('oef_witness_address')->nullable();
			$table->text('oef_witness_signature_file')->nullable();
			$table->text('oef_licensee_signature')->nullable();
			$table->text('oef_licensee_date')->nullable();
			$table->text('oef_licensee_page')->nullable();
			$table->text('oef_witness_name_2')->nullable();
			$table->text('oef_witness_occupation_2')->nullable();
			$table->text('oef_witness_address_2')->nullable();
			$table->text('oef_witness_signature_file_2')->nullable();
			$table->text('oef_signed_place_this')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('official_entry_forms');
	}
}
