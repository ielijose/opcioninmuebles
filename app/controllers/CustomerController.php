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
		return View::make('backend.customers.index', compact('customers'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /customer/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$categories = Category::all();
		$cities = City::all();
		$portals = Portal::all();
		$services = Service::all();

		$branches = Branch::all();

		$properties = Property::all();

		return View::make('backend.customers.create', compact('categories', 'cities', 'portals', 'services', 'branches', 'properties'));
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
		$inputs['estado'] = 'prospecto';

		$customer = new Customer($inputs);
		if ($customer->save())
		{
			return Redirect::to('/customer')->with('alert', ['type' => 'success', 'message' => 'El cliente ha sido registrado.']);;			
		}        
		dd($customer->getErrors());
        return Redirect::to('/customer')->with('alert', ['type' => 'danger', 'message' => 'Ocurrio un error, intenta mas tarde.']);;

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
		if(Input::has('ref') && Input::get('ref') == 'notify'){
			$n = Notification::unread()->find((int) Input::get('n'));
			if($n){
				$n->read();	
			}					
		}
		
		$categories = Category::all();
		$cities = City::all();
		$portals = Portal::all();
		$services = Service::all();

		$customer = Customer::findOrFail($id);
		return View::make('backend.customers.show', compact('customer', 'categories', 'cities', 'portals', 'services'));
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
		$inputs = Input::all();
		$customer = Customer::findOrFail($id);
		$customer->fill($inputs);
		if ($customer->save())
		{
			return Redirect::to('/customer/' . $id)->with('alert', ['type' => 'success', 'message' => 'Datos guardados.']);			
		}        
		dd($customer->getErrors());
        return Redirect::to('/customer/' . $id)->with('alert', ['type' => 'danger', 'message' => 'Ocurrio un error, intenta mas tarde.']);
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
		Customer::destroy($id);
		return Redirect::to('/customer')->with('alert', ['type' => 'success', 'message' => 'El cliente ha sido borrado.']);
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

	/**
	 * Update the specified resource in storage.
	 * PUT /customer/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function assign()
	{
		$inputs = Input::all();
		extract($inputs);
		
		$customer = Customer::findOrFail($id);
		$customer->assign($manager);
		
		return $customer->toJson();
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /customer/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function negotiate()
	{
		$inputs = Input::all();
		extract($inputs);
		
		$customer = Customer::findOrFail($id);
		$customer->negotiate($manager);
		
		return $customer->toJson();
	}

}