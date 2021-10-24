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

Route::get('/storage', function(){
    \Artisan::call('storage:link');
    return "Se han vinculado las imágenes";
});

Route::group(['middleware' => 'RevalidateBackHistory'],function(){
	Route::get('/home', 'HomeController@index');
	Route::get('/', function () {
		return view('welcome');
	});



	Auth::routes();

	Route::get('/home', 'HomeController@index')->name('home');

	// Events Route
	Route::get('/events', 'EventController@index')->name('eventList');
	Route::get('add_event', 'EventController@create')->name('add_event');
	Route::post('save_event', 'EventController@store')->name('save_event');
        Route::get('/edit_event/{event_id}', 'EventController@edit')->name('editEvent');
        Route::post('/update_event/{event_id}', 'EventController@update')->name('updateEvent');
        Route::get('delete_event', 'EventController@destroy')->name('delete_event');
        Route::get('/events/import-events-csv', 'EventController@importCSV')->name('importEventCSV');
        Route::post('/events/upload-csv', 'EventController@upload_attendee_csv')->name('uploadEventCSV');

	// User Type Route
	Route::get('/user-types', 'UsertypeController@index')->name('userTypes');
	Route::get('/add-type', 'UsertypeController@create')->name('addUserType');
	Route::post('/save-type', 'UsertypeController@store')->name('saveUserType');
	Route::get('/edit-type/{type_id}', 'UsertypeController@edit')->name('editUserType');
	Route::post('/update-type}', 'UsertypeController@update')->name('updateUserType');
	Route::get('/delete-type/{type_id}', 'UsertypeController@destroy')->name('deleteUserType');
        Route::get('/user-types/import-csv', 'UsertypeController@importCSV')->name('importUserTypesCSV');
        Route::post('/user-types/upload-csv', 'UsertypeController@upload_attendee_csv')->name('uploadUserTypesCSV');

	// Attendee Route
	Route::get('/attendees-list', 'AttendeeController@index')->name('attendeeList');
//	Route::get('/add-attendee/{eventId}', 'AttendeeController@create')->name('addAttendee');
	Route::post('/save-attendee', 'AttendeeController@store')->name('saveAttendee');
	Route::get('/attendee/import-csv', 'AttendeeController@importCSV')->name('importCSV');
	Route::post('/attendee/upload-csv', 'AttendeeController@upload_attendee_csv')->name('uploadCSV');
	Route::get('/attendee/edit/{attendee_id}', 'AttendeeController@edit')->name('editAttendee');
	Route::post('/attendee/update/{attendee_id}', 'AttendeeController@update')->name('updateAttendee');
	Route::get('/attendee/delete/{attendee_id}', 'AttendeeController@destroy')->name('deleteAttendee');
	Route::get('/attendee/sample-csv', 'AttendeeController@sampleCSV')->name('sampleCSV');
	Route::get('/attendee/add', 'AttendeeController@add_attendee')->name('addAttendee');
	Route::get('delete_all_attendee', 'AttendeeController@delete_all_attendee')->name('delete_all_attendee');

	// Templates Route
	Route::get('/templates', 'TemplateController@index')->name('templateList');
	Route::get('/create-template', 'TemplateController@create')->name('createTemplate');
	Route::post('/save-template', 'TemplateController@store')->name('saveTemplate');
	Route::get('/edit-template/{template_id}', 'TemplateController@edit')->name('editTemplate');
	Route::post('/update-template/{template_id}', 'TemplateController@update')->name('updateTemplate');
	Route::get('/delete-template/{template_id}', 'TemplateController@destroy')->name('deleteTemplate');
	Route::get('/design-template/{template_id}', 'TemplateController@designTemplate')->name('designTemplate');
	Route::post('/save-design-template', 'TemplateController@saveDesignTemplate')->name('saveDesignTemplate');
	Route::get('/export-template/{template_id}', 'TemplateController@exportTemplate')->name('exportTemplate');

	//Custom Module
	Route::get('/custom_field', 'CustomController@index')->name('custom_fields_view');
	Route::get('/custom_field/add', 'CustomController@add')->name('custom_fields_add');
	Route::post('/custom_field/store', 'CustomController@store');
	Route::get('/custom_field/edit/{id}', 'CustomController@edit')->name('custom_fields_update');
	Route::post('/custom_field/edit/update/{id}', 'CustomController@update');
	Route::get('/custom_visibility', 'CustomController@custom_visibility');
	Route::get('/custom_field/destroy/{id}', 'CustomController@destroy')->name('custom_fields_delete');
	Route::get('/delete_label_data', 'CustomController@delete_label_data');
	Route::get('/custom_field/sequence', 'CustomController@sequence');\
	Route::get('/custom_field/sequence1', 'CustomController@sequence1');//->name('manage_sequence'); delete after change sequenece code
	Route::post('/getCustomSequence', 'CustomController@sortsequence');
        Route::get('export_template_config/{id}', 'ExcelController@export_template_configuration');
        
        // Printing Station Controller:
        Route::get('print_attendee', 'PrintStationController@print_attendee')->name('print_attendee');
        Route::post('print_namebadge_by_serial_number', 'PrintStationController@print_namebadge_by_serial_number')->name('print_namebadge_by_serial_number');
        Route::get('update_attendee_printing_history', 'PrintStationController@update_attendee_printing_history')->name('update_attendee_printing_history');
        Route::get('print_report', 'PrintStationController@print_report')->name('print_report');
        Route::get('export_namebadge_print_details', 'ExcelController@export_namebadge_print_details')->name('export_namebadge_print_details');
});