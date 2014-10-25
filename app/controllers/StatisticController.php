<?php

class StatisticController extends BaseController {
	
	/**
	 * Store a newly created resource in storage.
	 * POST /api/statistic/{id}/{type}
	 *
	 * @return Response
	 */
	public function store($id, $type)
	{
		header('Access-Control-Allow-Origin: *');
		
		$property = Property::find($id);
		if(isset($property->id)){
			$data['property_id'] = $id;
			$data['type'] = $type;
			$data['ip'] = Request::getClientIp();

			$statistic = new Statistic($data);
			if ($statistic->save())
			{
				return $statistic->toJson();
			}
		}
		
	}

	/**
	 * Store a newly created resource in storage.
	 * GET /api/statistic/{id}
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$property = Property::find($id);
		if(isset($property->id)){
			$s = DB::table('statistics')
		      ->select(DB::raw('DATE(created_at) as date'), DB::raw('property_id, type'), DB::raw('count(*) as views'))
		      ->groupBy('property_id', 'date', 'type')
		      ->get();

		      return json_encode($s);
		}
		
	}
	    
}