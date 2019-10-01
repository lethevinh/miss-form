<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

use App\ContestantsInformationForm;

Route::get('/', function () {
	return view('welcome');
});

Route::get('/flight-information-form.html', function () {
	$data = FlightInformationForm::all();
	return view('admin.flight', ["data" => $data, 'fields' => FlightInformationForm::$fields]);
});

Route::get('/contestants-information-form.html', function () {
	$data = ContestantsInformationForm::all();
	return view('admin.information', ["data" => $data, 'fields' => ContestantsInformationForm::$fields]);
});
Route::get('/miss-charm-international-2020.html', function () {
	$data = \App\NationalDirectorForm::all();
	return view('admin.international', ["data" => $data, "fields" => \App\NationalDirectorForm::$fields]);
});
Route::get('/official-entry-form.html', function () {
	$data = \App\OfficialEntryForm::all();
	return view('admin.entry', ["data" => $data, 'fields' => \App\OfficialEntryForm::$fields]);
});

Route::get('/admin', function () {
	$data = ContestantsInformationForm::all();
	return view('admin.admin', ["data" => $data]);
});
