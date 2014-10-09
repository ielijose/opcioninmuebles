<?php

Route::group(array('before' => 'auth'), function()
{
	Route::get('/', ['uses' => 'AgentController@dashboard']);

});