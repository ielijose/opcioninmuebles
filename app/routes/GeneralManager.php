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
	
	/* Ubication */
	Route::get('/ubication', ['uses' => 'UbicationController@index']);

	Route::get('/api/country', ['uses' => 'UbicationController@country_index']);
	Route::post('/api/country', ['uses' => 'UbicationController@country_store']);
	Route::delete('/api/country/{id}', ['uses' => 'UbicationController@country_destroy']);

	Route::get('/api/country/{id}', ['uses' => 'UbicationController@estate_index']);
	Route::post('/api/estate', ['uses' => 'UbicationController@estate_store']);
	Route::delete('/api/estate/{id}', ['uses' => 'UbicationController@estate_destroy']);

	Route::get('/api/estate/{id}', ['uses' => 'UbicationController@city_index']);
	Route::post('/api/city', ['uses' => 'UbicationController@city_store']);
	Route::delete('/api/city/{id}', ['uses' => 'UbicationController@city_destroy']);
	
});