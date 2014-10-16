<?php

class PropertyController extends BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /branch
	 *
	 * @return Response
	 */        
	public function index()
	{
		$properties = Property::all();
		return View::make('backend.generalmanager.properties.index', compact('properties'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /branch/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('backend.generalmanager.properties.create');
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
		$inputs['image'] = (Session::has('property')) ? Session::get('property') : '';
		//dd($inputs);

		$property = new Property($inputs);
		if ($property->save())
		{
			return Redirect::to('/property')->with('alert', ['type' => 'success', 'message' => 'El inmueble ha sido guardado.']);;			
		}        
		dd($property->getErrors());
        return Redirect::to('/property')->with('alert', ['type' => 'danger', 'message' => 'Ocurrio un error, intenta mas tarde.']);;

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
		return View::make('backend.generalmanager.branches.show', compact('branch', 'categories', 'cities', 'portals', 'services'));
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
		return Redirect::to('/branch')->with('alert', ['type' => 'success', 'message' => 'La sucursal ha sido borrada.']);
	}

	public function add_image()
	{

		$file = Input::file('file');
        $destinationPath = public_path() . '/uploads/properties/';
        $filename = str_random(16)."_".$file->getClientOriginalName();
        $upload_success = Input::file('file')->move($destinationPath, $filename);

        if ($upload_success) {
            $property = '/uploads/properties/' . $filename;

            Session::put('property', $property);
            $response = ['property' => $property, 'success' => 200];

            return Response::json($response);
        } else {
            return Response::json('error', 400);
        }


	}	


	

}