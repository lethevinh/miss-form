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
            $templateProcessor->setValue($field, $mode->$field);
        }
        $name = Str::slug($mode->cif_country . '-' . $mode->cif_first_name, '-') . '.docx';
        $templateProcessor->saveAs(public_path('uploads/'$name));
        // dd(Storage::disk('public')->get($name));
        // return Storage::download(resource_path($name));
        return Storage::disk('public')->download('uploads/'$name);

    }
})->name('miss.get.contestants-information-form');

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
