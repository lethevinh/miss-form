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
Route::get('miss/contestants-information-form/print/{id}', function (Request $request, $id) {
    $mode = ContestantsInformationForm::find($id);
    if ($mode){
        $name = Str::slug($mode->cif_country.'-'.$mode->cif_first_name,'-').'.docx';
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('app/public/TemplateContestantsInformation.docx'));
        foreach (ContestantsInformationForm::$fields as $field) {
            $templateProcessor->setValue($field, $mode->$field);
        }

        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="' . $name . '"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');
        $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($templateProcessor, 'Word2007');
        $xmlWriter->save("php://output");

       //  $name = 'app/public/'.Str::slug($mode->cif_country.'-'.$mode->cif_first_name,'-').'.docx';
       // $templateProcessor->saveAs(storage_path($name));
       // return response()->json(['link'=> url($name)]);
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
