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
		return View::make('backend.branches.index', compact('branches'));
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

		$b = DB::table('branches')->orderBy('id', 'desc')->first();

		if($b){
			$id['id'] = $b->id + 1;
		}else{
			$id['id'] = 1;
		}

		return View::make('backend.branches.create', compact('categories', 'cities', 'countries', 'id'));
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
			return Redirect::to('/branch')->with('alert', ['type' => 'success', 'message' => 'La sucursal ha sido guardada.']);;			
		}        
		//dd($branch->getErrors());
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

		$branch = Branch::findOrFail($id);
		return View::make('backend.branches.show', compact('branch', 'categories', 'cities', 'portals', 'services'));
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
		$categories = Category::all();
		$cities = City::all();
		$portals = Portal::all();
		$services = Service::all();

		$branch = Branch::findOrFail($id);
		return View::make('backend.branches.edit', compact('branch', 'categories', 'cities', 'portals', 'services'));
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
		return Redirect::to('/branch')->with('alert', ['type' => 'success', 'message' => 'La sucursal ha sido borrada.']);
	}	

}