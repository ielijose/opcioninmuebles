<?php

class GeneralmanagerController extends BaseController {

	public function dashboard()
	{
		$data = [];

		$data['total'] = Customer::all()->count();
		$data['prospecto'] = Customer::estado('prospecto')->count();
		$data['asignado'] = Customer::estado('asignado')->count();
		$data['negociacion'] = Customer::estado('negociacion')->count();
		$data['interesado'] = Customer::estado('interesado')->count();
		$data['compro'] = Customer::estado('compro')->count();

		return View::make('backend.dashboard', ['data' => $data]);
	}

}