<?php

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \App\ContestantsInformationForm;
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
use Illuminate\Support\Facades\Storage;
Route::get('miss/contestants-information-form/print/{id}', function (Request $request, $id) {
    $mode = ContestantsInformationForm::find($id);
    if ($mode) {
        $pathFile = 'app/public/TemplateContestantsInformation.docx';
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(storage_path($pathFile));
        foreach (ContestantsInformationForm::$fields as $field) {
            if (strpos($mode->$field, 'uploads') !== false){
                $templateProcessor->setImageValue($field, array('path' => 'http://miss-form.osa.vn/'.$mode->$field, 'width' => 100, 'height' => 40, 'ratio' => false));
            }else{
                $templateProcessor->setValue($field, $mode->$field);
            }
        }
        $name = Str::slug('contestants-information-form-'.$mode->cif_country . '-' . $mode->cif_first_name, '-') . '.docx';
        $templateProcessor->saveAs(public_path('storage/'.$name));
        return Storage::disk('public')->download($name);
    }
})->name('miss.print.contestants-information-form');

Route::get('miss/official-entry-forms/print/{id}', function (Request $request, $id) {
    $model = \App\OfficialEntryForm::find($id);
    if ($model) {
        $pathFile = 'app/public/TemplateOfficialEntry.docx';
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(storage_path($pathFile));
        foreach (\App\OfficialEntryForm::$fields as $field) {
            if (strpos($model->$field, 'uploads') !== false){
                $templateProcessor->setImageValue($field, array('path' => 'http://miss-form.osa.vn/'.$model->$field, 'width' => 100, 'height' => 40, 'ratio' => false));
            }else{
                $templateProcessor->setValue($field, $model->$field);
            }
        }
        $name = Str::slug('official-entry-forms-'.$model->oef_country . '-' . $model->oef_winner_national_fullname, '-') . '.docx';
        $templateProcessor->saveAs(public_path('storage/'.$name));
        return Storage::disk('public')->download($name);
    }
})->name('miss.print.official-entry-forms');

Route::get('miss/national-director-form/print/{id}', function (Request $request, $id) {
    $model = \App\NationalDirectorForm::find($id);
    if ($model) {
        $pathFile = 'app/public/TemplateNationalDirector.docx';
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(storage_path($pathFile));
        foreach (\App\NationalDirectorForm::$fields as $field) {
            if ($field == 'ndf_licensee_signature'){
                $templateProcessor->setImageValue($field, array('path' => 'http://miss-form.osa.vn/'.$model->$field, 'width' => 100, 'height' => 40, 'ratio' => false));
            }else{
                $templateProcessor->setValue($field, $model->$field);
            }
        }
        $name = Str::slug('national-director-form-'.$model->ndf_your_company_name . '-' . $model->ndf_licensee_name, '-') . '.docx';
        $templateProcessor->saveAs(public_path('storage/'.$name));
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
    $files = ['oef_winner_signature_file','oef_signed_signature_file','oef_witness_signature_file','oef_witness_signature_file_2'];
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
