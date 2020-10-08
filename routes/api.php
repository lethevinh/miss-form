<?php

use App\FlightInformationForm;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Authorization, Content-Type');
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});
use \App\ContestantsInformationForm;
Route::get('miss/contestants-information-form/delete/{id}', function (Request $request, $id) {
	$mode = ContestantsInformationForm::find($id)->delete();
});

Route::get('miss/contestants-information-form/print/{id}', function (Request $request, $id) {
	$mode = ContestantsInformationForm::find($id);
	if ($mode) {
		$pathFile = 'app/public/TemplateContestantsInformation.docx';
		$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(storage_path($pathFile));
		foreach (ContestantsInformationForm::$fields as $field) {
			if (strpos($mode->$field, 'uploads') !== false) {
				$templateProcessor->setImageValue($field, array('path' => 'http://miss-form.osa.vn/' . $mode->$field, 'width' => 100, 'height' => 40, 'ratio' => false));
			} else {
				$templateProcessor->setValue($field, $mode->$field);
			}
		}
		$name = Str::slug('contestants-information-form-' . $mode->cif_country . '-' . $mode->cif_first_name, '-') . '.docx';
		$templateProcessor->saveAs(public_path('storage/' . $name));
		return Storage::disk('public')->download($name);
	}
})->name('miss.print.contestants-information-form');

Route::get('miss/official-entry-forms/delete/{id}', function (Request $request, $id) {
	$model = \App\OfficialEntryForm::find($id)->delete();
});

Route::get('miss/official-entry-forms/print/{id}', function (Request $request, $id) {
	$model = \App\OfficialEntryForm::find($id);
	if ($model) {
		$pathFile = 'app/public/TemplateOfficialEntry.docx';
		$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(storage_path($pathFile));
		foreach (\App\OfficialEntryForm::$fields as $field) {
			if (strpos($model->$field, 'uploads') !== false) {
				$templateProcessor->setImageValue($field, array('path' => 'http://miss-form.osa.vn/' . $model->$field, 'width' => 100, 'height' => 40, 'ratio' => false));
			} else {
				$templateProcessor->setValue($field, $model->$field);
			}
		}
		$name = Str::slug('official-entry-forms-' . $model->oef_country . '-' . $model->oef_winner_national_fullname, '-') . '.docx';
		$templateProcessor->saveAs(public_path('storage/' . $name));
		return Storage::disk('public')->download($name);
	}
})->name('miss.print.official-entry-forms');

Route::get('miss/national-director-form/delete/{id}', function (Request $request, $id) {
	$model = \App\NationalDirectorForm::find($id)->delete();
});

Route::get('miss/national-director-form/print/{id}', function (Request $request, $id) {
	$model = \App\NationalDirectorForm::find($id);
	if ($model) {
		$pathFile = 'app/public/TemplateNationalDirector.docx';
		$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(storage_path($pathFile));
		foreach (\App\NationalDirectorForm::$fields as $field) {
			if ($field == 'ndf_licensee_signature') {
				$templateProcessor->setImageValue($field, array('path' => 'http://miss-form.osa.vn/' . $model->$field, 'width' => 100, 'height' => 40, 'ratio' => false));
			} else {
				$templateProcessor->setValue($field, $model->$field);
			}
		}
		$name = Str::slug('national-director-form-' . $model->ndf_your_company_name . '-' . $model->ndf_licensee_name, '-') . '.docx';
		$templateProcessor->saveAs(public_path('storage/' . $name));
		return Storage::disk('public')->download($name);
	}
})->name('miss.print.contestants-information-form');

Route::get('miss/contestants-information-form', function (Request $request) {
	return response()->json(ContestantsInformationForm::all());
})->name('miss.get.contestants-information-form');

Route::post('miss/contestants-information-form', function (Request $request) {
	$input = request()->input();
	$files = ['cif_passport_image', 'cif_portrait_file', 'cif_full_long_shot_bikini_file', 'cif_full_long_shot_evening_gown_file', 'cif_signature_file'];
	foreach ($files as $key => $value) {
		if ($request->hasFile($value)) {
			$file = request()->$value;
			$name = $input['cif_first_name'] . '_' . $input['cif_family_name'];
			$imageName = Str::slug(time() . '_' . $value . '_' . $name, '-') . '.' . $file->getClientOriginalExtension();
			$path = $file->move(public_path('uploads'), $imageName);
			$input[$value] = 'uploads' . '/' . $imageName;
		}
	}
	$model = ContestantsInformationForm::create($input);
	return response()->json($model);
})->name('miss.contestants-information-form');

Route::post('miss/national-director-form', function (Request $request) {
	$input = $request->input();
	$files = ['ndf_licensee_signature'];
	foreach ($files as $key => $value) {
		if ($request->hasFile($value)) {
			$file = request()->$value;
			$name = $input['ndf_licensee_name'] . '_' . $input['ndf_licensee_surname'];
			$imageName = Str::slug(time() . '_' . $value . '_' . $name, '-') . '.' . $file->getClientOriginalExtension();
			$path = $file->move(public_path('uploads'), $imageName);
			$input[$value] = 'uploads' . '/' . $imageName;
		}
	}
	$model = \App\NationalDirectorForm::create($input);
	return response()->json($model);
})->name('miss.national-director-form');

Route::post('miss/official-entry-forms', function (Request $request) {
	$input = $request->input();
	$files = ['oef_winner_signature_file', 'oef_signed_signature_file', 'oef_witness_signature_file', 'oef_witness_signature_file_2'];
	foreach ($files as $key => $value) {
		if ($request->hasFile($value)) {
			$file = request()->$value;
			$name = $input['oef_winner_national_fullname'] . '_' . $input['oef_country'];
			$imageName = Str::slug(time() . '_' . $value . '_' . $name, '-') . '.' . $file->getClientOriginalExtension();
			$path = $file->move(public_path('uploads'), $imageName);
			$input[$value] = 'uploads' . '/' . $imageName;
		}
	}
	$model = \App\OfficialEntryForm::create($input);
	return response()->json($model);
})->name('miss.national-director-form');
// ------------
Route::post('miss/flight-information-form', function (Request $request) {
	$input = $request->input();
	$files = ['fif_file_passport', 'fif_file_signed'];
	foreach ($files as $key => $value) {
		if ($request->hasFile($value)) {
			$file = request()->$value;
			$name = $input['fif_country'] . '_' . $input['fif_name'];
			$imageName = Str::slug(time() . '_' . $value . '_' . $name, '-') . '.' . $file->getClientOriginalExtension();
			$path = $file->move(public_path('uploads'), $imageName);
			$input[$value] = 'uploads' . '/' . $imageName;
		}
	}
	$model = \App\FlightInformationForm::create($input);
	return response()->json($model);
})->name('miss.flight-information-form');

Route::get('miss/flight-information-form/delete/{id}', function (Request $request, $id) {
	$model = \App\FlightInformationForm::find($id)->delete();
});
Route::get('miss/flight-information-form/print/{id}', function (Request $request, $id) {
	$model = \App\FlightInformationForm::find($id);
	if ($model) {
		$pathFile = 'app/public/TemplateFlightInformation.docx';
		$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(storage_path($pathFile));
		foreach (\App\FlightInformationForm::$fields as $field) {
			if ($field == 'fif_file_passport' || $field == 'fif_file_signed') {
				$templateProcessor->setImageValue($field, array('path' => 'http://miss-form.osa.vn/' . $model->$field, 'width' => 100, 'height' => 40, 'ratio' => false));
			} else {
				$templateProcessor->setValue($field, $model->$field);
			}
		}
		$name = Str::slug('flight-information-form-' . $model->fif_country . '-' . $model->fif_name, '-') . '.docx';
		$templateProcessor->saveAs(public_path('storage/' . $name));
		return Storage::disk('public')->download($name);
	}
})->name('miss.print.contestants-information-form');

Route::get('v1/test-chat-bot', function (Request $request) {
	/* return response()->json([
		"success" => true,
		"errorCode" => "200",
		"errorMsg" => "",
		"fields" => [
			"country" => "Vietnam",
			"cases" => 95,
			"todayCases" => 0,
			"deaths" => 0,
			"todayDeaths" => 0,
			"recovered" => 17,
			"critical" => 0,
		],
	]);*/
	$client = new Client();
	$res = $client->request('GET', 'https://disease.sh/v2/countries', [
		'headers' => [
			'Content-Type' => 'application/json',
		],
	]);

	$data = json_decode($res->getBody());
	$name = "Vietnam";
	$venture = strtoupper($request->input('venture'));
	switch ($venture) {
	case 'TH':
		$name = "Thailand";
		break;

	case 'ID':
		$name = "Indonesia";
		break;

	case 'MY':
		$name = "Malaysia";
		break;

	case 'SG':
		$name = "Singapore";
		break;

	case 'PH':
		$name = "Philippines";
		break;

	case 'CH':
		$name = "China";
		break;

	default:
		$name = "Vietnam";
		break;
	}

	if ($venture == "VN") {
		$country = [
			"country" => "Vietnam",
			"cases" => 57,
			"todayCases" => 0,
			"deaths" => 0,
			"todayDeaths" => 0,
			"recovered" => 16,
			"critical" => 0,
		];
	}

	$first = Arr::first($data, function ($value, $key) use ($name) {
		return $value->country == $name;
	});

	return response()->json([
		"success" => true,
		"errorCode" => "200",
		"errorMsg" => "",
		"fields" => $first,
	]);
})->name('miss.print.contestants-information-form');

Route::get('v1/test-chat-bot-2', function (Request $request) {
	$client = new Client();
	$res = $client->request('GET', 'https://disease.sh/v2/countries', [
		'headers' => [
			'Content-Type' => 'application/json',
		],
	]);

	$results = json_decode($res->getBody());
	dd($results);
})->name('miss.print.contestants-information-form');