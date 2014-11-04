<?php

class ManagerzoneController extends BaseController {

	public function dashboard()
	{
		return View::make('backend.dashboard');
	}

	public function branch()
	{
		$id = Auth::user()->branch_id;
		$categories = Category::all();
		$cities = City::all();
		$portals = Portal::all();
		$services = Service::all();

		$branch = branch::findOrFail($id);
		return View::make('backend.branches.show', compact('branch', 'categories', 'cities', 'portals', 'services'));
	}
	
	public function user()
	{
		$users = User::current(Auth::user()->branch_id)->paginate(8);
		return View::make('backend.users.index', compact('users'));
	}

	public function customer()
	{
		$customers = Customer::current(Auth::user()->branch_id)->get();
		return View::make('backend.customers.index', compact('customers'));
	}

}