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