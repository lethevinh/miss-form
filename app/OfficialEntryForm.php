<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfficialEntryForm extends Model {
	protected $table = 'official_entry_forms';
	protected $fillable =
		[
		"oef_country",
		"oef_winner_national_fullname",
		"oef_winner_national_country",
		"oef_winner_national_address",
		"oef_licensee_name",
		"oef_licensee_country",
		"oef_licensee_country_laws",
		"oef_licensee_address",
		"oef_licensee_national_country",
		"oef_winner_date",
		"oef_winner_place",
		"oef_winner_signature_file",
		"oef_signed_name",
		"oef_signed_name_and",
		"oef_signed_name_of",
		"oef_signed_signature_file",
		"oef_signed_date",
		"oef_signed_place",
		"oef_witness_name",
		"oef_witness_occupation",
		"oef_witness_address",
		"oef_witness_signature_file",
		"oef_licensee_signature",
		"oef_licensee_date",
		"oef_licensee_page",
		"oef_witness_name_2",
		"oef_witness_occupation_2",
		"oef_witness_address_2",
		"oef_witness_signature_file_2",
		"oef_signed_place_this",
	];

	public static $fields = [
		"oef_country",
		"oef_winner_national_fullname",
		"oef_winner_national_country",
		"oef_winner_national_address",
		"oef_licensee_name",
		"oef_licensee_country",
		"oef_licensee_country_laws",
		"oef_licensee_address",
		"oef_licensee_national_country",
		"oef_winner_date",
		"oef_winner_place",
		"oef_winner_signature_file",
		"oef_signed_name",
		"oef_signed_name_and",
		"oef_signed_name_of",
		"oef_signed_signature_file",
		"oef_signed_date",
		"oef_signed_place",
		"oef_witness_name",
		"oef_witness_occupation",
		"oef_witness_address",
		"oef_witness_signature_file",
		"oef_licensee_signature",
		"oef_licensee_date",
		"oef_licensee_page",
		"oef_witness_name_2",
		"oef_witness_occupation_2",
		"oef_witness_address_2",
		"oef_witness_signature_file_2",
		"oef_signed_place_this",
	];
}
