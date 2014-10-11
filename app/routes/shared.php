<?php

Route::any('product/{id}/question', ['uses' => 'QuestionController@store']);

/* Panel */
Route::group(array('before' => 'auth'), function()
{
	Route::get('profile', ['uses' => 'SharedController@profile']);
	Route::post('profile', ['uses' => 'SharedController@post_profile']);
	
	/* Avatar de usuario */
	Route::post('avatar', ['uses' => 'UploadController@post_avatar']);
	Route::get('avatar', ['uses' => 'UploadController@get_avatar']);	
	Route::any('avatar/crop', ['uses' => 'UploadController@post_avatar_crop']);
	Route::any('avatar/rotate', ['uses' => 'UploadController@post_avatar_rotate']);

	/* Avatar de empresa */
	Route::post('picture', ['uses' => 'UploadController@post_picture']);
	Route::get('picture', ['uses' => 'UploadController@get_picture']);	
	Route::any('picture/crop', ['uses' => 'UploadController@post_picture_crop']);

	/* Cover de empresa */
	Route::post('cover', ['uses' => 'UploadController@post_cover']);
	Route::get('cover', ['uses' => 'UploadController@get_cover']);
	Route::any('cover/crop', ['uses' => 'UploadController@post_cover_crop']);
});