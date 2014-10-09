<?php

class ReceptionistController extends BaseController {

	public function dashboard()
	{
		return View::make('backend.receptionist.dashboard');
	}

}