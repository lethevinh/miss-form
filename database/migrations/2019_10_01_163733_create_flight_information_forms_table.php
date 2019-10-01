<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightInformationFormsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('flight_information_forms', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->text("fif_country")->nullable();
			$table->text("fif_name")->nullable();
			$table->text("fif_file_passport")->nullable();
			$table->text("fif_airline")->nullable();
			$table->text("fif_arrival")->nullable();
			$table->text("fif_flight_no")->nullable();
			$table->text("fif_arrival_date")->nullable();
			$table->text("fif_airline_reservation")->nullable();
			$table->text("fif_contestant_name")->nullable();
			$table->text("fif_arrival_airport")->nullable();
			$table->text("fif_terminal")->nullable();
			$table->text("fif_airline_2")->nullable();
			$table->text("fif_departure_date")->nullable();
			$table->text("fif_flight_no_2")->nullable();
			$table->text("fif_departure_time")->nullable();
			$table->text("fif_departure_airport")->nullable();
			$table->text("fif_terminal_2")->nullable();
			$table->text("fif_file_signed")->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('flight_information_forms');
	}
}
