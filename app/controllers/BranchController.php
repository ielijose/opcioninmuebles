<?php

class BranchController extends BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /branch
	 *
	 * @return Response
	 */        
	public function index()
	{
		$branches = Branch::all();
		return View::make('backend.generalmanager.branches.index', compact('branches'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /branch/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$categories = Category::all();
		$cities = City::all();
		$countries = Country::all();

		return View::make('backend.generalmanager.branches.create', compact('categories', 'cities', 'countries'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /branch
	 *
	 * @return Response
	 */
	public function store()
	{
		$inputs = Input::all();

		$branch = new Branch($inputs);
		if ($branch->save())
		{
			return Redirect::to('/branch')->with('alert', ['type' => 'success', 'message' => 'El cliente ha sido registrado.']);;			
		}        
		dd($branch->getErrors());
        return Redirect::to('/branch')->with('alert', ['type' => 'danger', 'message' => 'Ocurrio un error, intenta mas tarde.']);;

	}

	/**
	 * Display the specified resource.
	 * GET /branch/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$categories = Category::all();
		$cities = City::all();
		$portals = Portal::all();
		$services = Service::all();

		$branch = branch::findOrFail($id);
		return View::make('backend.generalmanager.branchs.show', compact('branch', 'categories', 'cities', 'portals', 'services'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /branch/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

	}

	/**
	 * Update the specified resource in storage.
	 * PUT /branch/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$inputs = Input::all();
		$branch = branch::findOrFail($id);
		$branch->fill($inputs);
		if ($branch->save())
		{
			return Redirect::to('/branch/' . $id)->with('alert', ['type' => 'success', 'message' => 'Datos guardados.']);			
		}        
		dd($branch->getErrors());
        return Redirect::to('/branch/' . $id)->with('alert', ['type' => 'danger', 'message' => 'Ocurrio un error, intenta mas tarde.']);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /branch/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		branch::destroy($id);
		return Redirect::to('/branch')->with('alert', ['type' => 'success', 'message' => 'El cliente ha sido borrado.']);
	}

	public function verify()
	{
		$email = Input::get('email');

		$c = branch::where('email', $email)->get();

		$available = true;

		if(count($c) > 0){
			$available = false;
		}	

		return json_encode($available);
	}

}