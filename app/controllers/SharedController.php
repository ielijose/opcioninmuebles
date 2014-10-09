<?php

class SharedController extends BaseController {

	public function product_question($id)
	{
		
	}		

	public function profile()
	{
		return View::make('backend.shared.profile');
	}

	public function post_profile()
	{
		$inputs = Input::all();
		//dd($inputs);
		/* Formas de pago */
		$methods = ['efectivo', 'debito', 'transferencia', 'cheque', 'visa', 'mastercard'];

		$inputs['user_id'] = Auth::user()->id;

		$pid = (isset(Auth::user()->payment->id)) ? Auth::user()->payment->id : null;

		$payment = Payment::firstOrNew(array('id' => $pid));

		foreach($methods as $key => $method){
			$payment->$method = 0;
		}

		$payment->fill($inputs);
		$payment->save();
		/* :Formas de pago */

		$rules = User::$rules;
		$messages = User::$messages;

		unset($rules['type']);
		$rules['email'] .= ',email,' . Auth::user()->id;

		$inputs['password'] = Auth::user()->password;
		
		$v = Validator::make($inputs, $rules, $messages);
		
		if ($v->passes())
		{
			$user = User::find(Auth::user()->id);
			$user->fill($inputs);
			$user->save();
			return Redirect::to('/panel/profile')->with('alert', ['type' => 'success', 'message' => 'Su perfil se ha actualizado.']);
		}else{
			return Redirect::back()->withInput()->withErrors($v->messages());
		}

		return View::make('backend.shared.profile');
	}	

}
