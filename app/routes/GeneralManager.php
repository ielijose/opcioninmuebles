<?php

Route::group(array('before' => 'auth'), function()
{
	Route::get('/', ['uses' => 'GeneralmanagerController@dashboard']);

	/* Customer */
	Route::get('/customers', ['uses' => 'CustomerController@index']);

	Route::get('/customer/create', ['uses' => 'CustomerController@create']);
	Route::post('/customer', ['uses' => 'CustomerController@store']);	

	Route::post('/verify-email', ['uses' => 'CustomerController@verify']);

	/* Branches */
	Route::get('/branches', ['uses' => 'BranchesController@index']);
	Route::get('/branch/create', ['uses' => 'BranchesController@create']);
	Route::post('/branch', ['uses' => 'BranchesController@store']);
	
});