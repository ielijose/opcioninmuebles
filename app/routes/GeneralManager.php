<?php

Route::group(array('before' => 'auth'), function()
{
	Route::get('/', ['uses' => 'GeneralmanagerController@dashboard']);

	/* Customer */

	Route::resource('customer', 'CustomerController');
	/*
	Route::get('/customers', ['uses' => 'CustomersController@index']);

	Route::get('/customer/create', ['uses' => 'CustomersController@create']);
	Route::post('/customer', ['uses' => 'CustomersController@store']);	*/

	Route::post('/verify-email', ['uses' => 'CustomerController@verify']);

	
	/* Branch */
	Route::get('/branches', ['uses' => 'BranchesController@index']);
	Route::get('/branch/create', ['uses' => 'BranchesController@create']);
	Route::post('/branch', ['uses' => 'BranchesController@store']);
	
	
});