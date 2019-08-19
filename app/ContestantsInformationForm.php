<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContestantsInformationForm extends Model {
	//
	protected $table = 'contestants_information_forms';
	protected $fillable = [
		'cif_country',
		'cif_family_name',
		'cif_first_name',
		'cif_address',
		'cif_daytime_tel_no',
		'cif_evening_tel_no',
		'cif_father_full_name',
		'cif_father_occupation',
		'cif_mother_full_name',
		'cif_mother_occupation',
		'cif_your_age',
		'cif_birth_day',
		'cif_passport_number',
		'cif_passport_place_of_issue',
		'cif_date_of_issue',
		'cif_expity_date',
		'cif_curren_occupation',
		'cif_education',
		'cif_your_title',
		'cif_link_facebook',
		'cif_link_instagram',
		'cif_blood_group',
		'cif_alergies',
		'cif_name_telephone',
		'cif_passport_image',
		'cif_bust_size',
		'cif_cup_size',
		'cif_waist',
		'cif_hips',
		'cif_shoulders',
		'cif_height',
		'cif_hat_size',
		'cif_dress_size',
		'cif_shoe_size',
		'cif_colour_of_eyes',
		'cif_colour_of_hair',
		'cif_portrait_file',
		'cif_full_long_shot_bikini_file',
		'cif_full_long_shot_evening_gown_file',
		'cif_signature_file',
		'cif_date_signature',
	];
}
