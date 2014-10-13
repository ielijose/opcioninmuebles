<?php

class UbicationController extends BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /ubication
	 *
	 * @return Response
	 */        
	public function index()
	{
		return View::make('backend.generalmanager.ubication.index');
	}
	

	/* Country */

	/**
	 * Display a listing of the resource.
	 * GET /country
	 *
	 * @return Response
	 */        
	public function country_index()
	{
		$country = Country::all();
		return $country->toJson();
	}

	public function country_store()
	{
		$i = Input::all();		
		$country = Country::create($i);
		$country->save();
		return Redirect::to('/api/country');
	}

	public function country_destroy($id)
	{
		foreach(Country::find($id)->estates as $estate){
			foreach(Estate::find($estate->id)->cities as $city){
				City::destroy($city->id);
			}
			Estate::destroy($estate->id);
		}
		Country::destroy($id);
		
		$country = Country::all();
		return $country->toJson();
	}

	/* Estate */

	/**
	 * Display a listing of the resource.
	 * GET /estate
	 *
	 * @return Response
	 */        
	public function estate_index($id)
	{
		$estate = Country::find($id)->estates;
		return $estate->toJson();
	}

	public function estate_store()
	{
		$i = Input::all();		
		$estate = Estate::create($i);
		$estate->save();
		return Redirect::action('UbicationController@estate_index', array($estate->country_id));
	}

	public function estate_destroy($id)
	{
		foreach(Estate::find($id)->cities as $city){
			City::destroy($city->id);
		}

		$estate = Estate::find($id);
		Estate::destroy($id);

		$estate = Country::find($estate->country_id)->estates;
		return $estate->toJson();
	}


	/* City */

	/**
	 * Display a listing of the resource.
	 * GET /city
	 *
	 * @return Response
	 */        
	public function city_index($id)
	{
		$city = Estate::find($id)->cities;
		return $city->toJson();
	}

	public function city_store()
	{
		$i = Input::all();		
		$city = City::create($i);
		$city->save();
		return Redirect::action('UbicationController@city_index', array($city->estate_id));
	}

	public function city_destroy($id)
	{
		$city = City::find($id);
		City::destroy($id);

		$cities = Estate::find($city->estate_id)->cities;
		return $cities->toJson();
	}

}