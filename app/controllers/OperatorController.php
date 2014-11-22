<?php

class OperatorController extends BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /branch
	 *
	 * @return Response
	 */        
	public function index()
	{
		$operators = Operator::paginate(8);
		return View::make('backend.operators.index', compact('operators'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /branch/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('backend.operators.create');
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
		
		//dd($inputs);

		$operator = new Operator($inputs);
		if ($operator->save())
		{
			return Redirect::to('/operator')->with('alert', ['type' => 'success', 'message' => 'El operador ha sido registrado.']);;			
		}        
		//dd($branch->getErrors());
        return Redirect::to('/operator')->with('alert', ['type' => 'danger', 'message' => 'Ocurrio un error, intenta mas tarde.']);;

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
 		$operator = Operator::find($id);
		return View::make('backend.operators.manage', compact('operator'));
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
		$operator = Operator::findOrFail($id);
		$operator->fill($inputs);
		if ($operator->save())
		{
			return Redirect::to('/operator')->with('alert', ['type' => 'success', 'message' => 'Datos guardados.']);			
		}        
        return Redirect::to('/operator/' . $id)->with('alert', ['type' => 'danger', 'message' => 'Ocurrio un error, intenta mas tarde.']);
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
		Operator::destroy($id);
	}
}