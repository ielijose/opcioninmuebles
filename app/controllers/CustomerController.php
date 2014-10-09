<?php

class CustomerController extends BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /customer
	 *
	 * @return Response
	 */
	public function index()
	{
		$customers = Customer::all();
		return View::make('backend.generalmanager.customers.index', ['customers' => $customers]);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /customer/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('backend.generalmanager.customers.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /customer
	 *
	 * @return Response
	 */
	public function store()
	{
		$inputs = Input::all();
		$inputs['user_id'] = Auth::user()->id;

		$customer = new Customer($inputs);
		if ($customer->save())
		{
			return Redirect::to('/customers')->with('alert', ['type' => 'success', 'message' => 'El cliente ha sido registrado.']);;			
		}        
		dd($customer->getErrors());
        return Redirect::to('/customers')->with('alert', ['type' => 'danger', 'message' => 'Ocurrio un error, intenta mas tarde.']);;

	}

	/**
	 * Display the specified resource.
	 * GET /customer/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /customer/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /customer/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /customer/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function verify()
	{
		$email = Input::get('email');

		$c = Customer::where('email', $email)->get();

		$available = true;

		if(count($c) > 0){
			$available = false;
		}	

		return json_encode($available);
	}

}