<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NationalDirectorForm extends Model
{
    protected $table = 'national_director_forms';
    protected $fillable = [
        "ndf_your_company_name",
        "ndf_company_organized",
        "ndf_your_company_address",
        "ndf_licensee_company_name",
        "ndf_licensee_designation",
        "ndf_licensee_date",
        "ndf_licensee_signature",
        "ndf_licensee_name",
        "ndf_licensee_surname",
        "ndf_licensee_passport_number",
        "ndf_licensee_gender",
        "ndf_licensee_phone",
        "ndf_licensee_email",
        "ndf_licensee_facebook",
        "ndf_licensee_incumbebt_post",
        "ndf_licensee_company_phone",
        "ndf_licensee_present_address",
        "ndf_licensee_company_address",
        "ndf_licensee_mother_tongue",
        "ndf_licensee_english_level",
        "ndf_licensee_other_foreign_languages",
        "ndf_licensee_company_introduction",
        "ndf_licensee_your_advantages",
        "ndf_licensee_mci",
        "ndf_licensee_full_name",
        "ndf_licensee_contact_number",
        "ndf_licensee_relationship",
        "ndf_licensee_email",
        "ndf_licensee_contact_address",
        "ndf_general_contact_name",
        "ndf_general_contact_title",
        "ndf_general_contact_tel",
        "ndf_general_contact_mobile",
        "ndf_general_contact_email",
        "ndf_develop_team_contact_email",
        "ndf_develop_team_contact_name",
        "ndf_develop_team_contact_tel",
        "ndf_develop_team_contact_mobile",
        "ndf_develop_team_contact_email",
    ];
}
