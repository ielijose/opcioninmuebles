<?php

class UserController extends BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /branch
	 *
	 * @return Response
	 */        
	public function index()
	{
		$users = User::paginate(8);
		return View::make('backend.users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /branch/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$branches = Branch::all();
		return View::make('backend.users.create', compact('branches'));
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

		if(Session::has('upload')){		

			if(File::exists(public_path() . Session::get('upload'))){
				$f = Session::get('upload');
				$filename = pathinfo($f, PATHINFO_BASENAME);

				File::move(public_path() .Session::get('upload'), public_path() .'/uploads/avatar/' . $filename);
				$inputs['profile_picture'] = '/uploads/avatar/' . $filename;
				Session::forget('upload');
			}
			
		}
		
		//dd($inputs);

		$user = new User($inputs);
		if ($user->save())
		{
			return Redirect::to('/user')->with('alert', ['type' => 'success', 'message' => 'El usuario ha sido registrado.']);;			
		}        
		//dd($branch->getErrors());
        return Redirect::to('/user')->with('alert', ['type' => 'danger', 'message' => 'Ocurrio un error, intenta mas tarde.']);;

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
 		$user = User::find($id);
		return View::make('backend.users.manage', compact('user'));
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
		//dd($inputs);

		$rules = User::$rules;
		$messages = User::$messages;

		if($inputs['password'] == ''){
			unset($rules['password']);
			unset($inputs['password']);

			unset($rules['password_confirmation']);
			unset($inputs['password_confirmation']);
		}else{
			$rules['password'] .= '|confirmed';			
		}

		unset($rules['type']);
		$rules['email'] .= ',email,' . $id;
		
		$v = Validator::make($inputs, $rules, $messages);
		
		if ($v->passes())
		{
			$user = User::find($id);
			$user->fill($inputs);
			if ($user->save()){
				return Redirect::to('/user/' . $id . '/edit')->with('alert', ['type' => 'success', 'message' => 'Su perfil se ha actualizado.']);
			}
			
		}
		return Redirect::back()->withInput()->withErrors($v->messages());
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
		User::destroy($id);
	}	


	public function verify()
	{
		$email = Input::get('email');

		$c = User::where('email', $email)->get();

		$available = true;

		if(count($c) > 0){
			$available = false;
		}	

		return json_encode($available);
	}

	public function api_type($type)
	{
		$users = User::where('type', $type)->get();
		$data = [];
		foreach ($users as $key => $user) {
			$user->profile_picture = $user->getProfilePicture();
			array_push($data, $user);
		}

		return json_encode($data);
	}

	public function api_current_type($type)
	{
		$users = User::current(Auth::user()->branch_id)->where('type', $type)->get();
		$self = Auth::user();
		$data = [];
		$self->profile_picture = $self->getProfilePicture();
		array_push($data, $self);

		foreach ($users as $key => $user) {
			$user->profile_picture = $user->getProfilePicture();
			array_push($data, $user);
		}
		
		return json_encode($data);
	}
}