<?php

Route::group(array('before' => 'auth'), function()
{
	Route::get('/', ['uses' => 'ManagerZoneController@dashboard']);

	/* Customer */
	Route::resource('customer', 'CustomerController');

});