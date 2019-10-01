<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlightInformationForm extends Model {
	protected $table = 'flight_information_forms';
	protected $fillable = [
		"fif_country",
		"fif_name",
		"fif_file_passport",
		"fif_airline",
		"fif_arrival",
		"fif_flight_no",
		"fif_arrival_date",
		"fif_airline_reservation",
		"fif_contestant_name",
		"fif_arrival_airport",
		"fif_terminal",
		"fif_airline_2",
		"fif_departure_date",
		"fif_flight_no_2",
		"fif_departure_time",
		"fif_departure_airport",
		"fif_terminal_2",
		"fif_file_signed",
	];

	public static $fields = [
		"fif_country",
		"fif_name",
		"fif_file_passport",
		"fif_airline",
		"fif_arrival",
		"fif_flight_no",
		"fif_arrival_date",
		"fif_airline_reservation",
		"fif_contestant_name",
		"fif_arrival_airport",
		"fif_terminal",
		"fif_airline_2",
		"fif_departure_date",
		"fif_flight_no_2",
		"fif_departure_time",
		"fif_departure_airport",
		"fif_terminal_2",
		"fif_file_signed",
	];
}
