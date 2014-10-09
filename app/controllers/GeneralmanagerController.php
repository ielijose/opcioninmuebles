<?php

class GeneralmanagerController extends BaseController {

	public function dashboard()
	{
		return View::make('backend.generalmanager.dashboard');
	}

}