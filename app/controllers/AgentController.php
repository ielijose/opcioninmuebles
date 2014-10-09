<?php

class AgentController extends BaseController {

	public function dashboard()
	{
		return View::make('backend.agent.dashboard');
	}

}