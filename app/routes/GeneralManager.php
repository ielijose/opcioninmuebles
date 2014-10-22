<?php

Route::group(array('before' => 'auth'), function()
{
	Route::get('/', ['uses' => 'GeneralmanagerController@dashboard']);

	/* Customer */
	Route::resource('customer', 'CustomerController');
	Route::post('/verify-email', ['uses' => 'CustomerController@verify']);
	
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

	/* API */
	Route::get('/api/country', ['uses' => 'UbicationController@country_index']);
	Route::post('/api/country', ['uses' => 'UbicationController@country_store']);
	Route::delete('/api/country/{id}', ['uses' => 'UbicationController@country_destroy']);

	Route::get('/api/country/{id}', ['uses' => 'UbicationController@estate_index']);
	Route::post('/api/estate', ['uses' => 'UbicationController@estate_store']);
	Route::delete('/api/estate/{id}', ['uses' => 'UbicationController@estate_destroy']);

	Route::get('/api/estate/{id}', ['uses' => 'UbicationController@city_index']);
	Route::post('/api/city', ['uses' => 'UbicationController@city_store']);
	Route::delete('/api/city/{id}', ['uses' => 'UbicationController@city_destroy']);

	/* API Property */
	Route::get('/api/property', ['uses' => 'PropertyController@api_index']);

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