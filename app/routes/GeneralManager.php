<?php

Route::group(array('before' => 'auth'), function()
{
	Route::get('/', ['uses' => 'GeneralmanagerController@dashboard']);

	/* Customer */
	Route::resource('customer', 'CustomerController');
	Route::post('/customer/assign', ['uses' => 'CustomerController@assign']);
	
	/* Branch */
	Route::resource('branch', 'BranchController');

	/* User */
	Route::resource('user', 'UserController');	
	Route::post('/verify-user-email', ['uses' => 'UserController@verify']);

	
	/* Ubication */
	Route::get('/ubication', ['uses' => 'UbicationController@index']);

	/* Property */
	Route::resource('property', 'PropertyController');
	Route::post('/property/image', ['uses' => 'PropertyController@add_image']);


	/* Avatar de usuario */
	Route::post('upload', ['uses' => 'UploadController@post_upload']);
	Route::get('upload', ['uses' => 'UploadController@get_upload']);	
	Route::any('upload/crop', ['uses' => 'UploadController@post_upload_crop']);
	Route::any('upload/rotate', ['uses' => 'UploadController@post_upload_rotate']);

	/* imagen de inmueble */
	Route::post('/property/image/{id}', ['uses' => 'PropertyController@post_image']);
	Route::get('/property/image/{id}', ['uses' => 'PropertyController@get_image']);	
	Route::any('/property/image/{id}/crop', ['uses' => 'PropertyController@image_crop']);
	
});