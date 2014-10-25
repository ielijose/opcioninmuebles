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
			$statistics = DB::table('statistics')
		      ->select(DB::raw('DATE(created_at) as date'), DB::raw('property_id, type'), DB::raw('count(*) as views'))
		      ->groupBy('property_id', 'date', 'type')
		      ->where('property_id', $id)
		      ->get();
		      $data = ['id' => $id];
		      foreach ($statistics as $key => $statistic) {
		      	$data[$statistic->property_id][$statistic->type] = ['date' => $statistic->date, 'views' => $statistic->views];

		      }

		      return json_encode($data);
		}
		
	}

	/**
	 * Store a newly created resource in storage.
	 * GET /api/statistic/{id}
	 *
	 * @return Response
	 */
	public function statistics()
	{
		$statistics = DB::table('statistics')
		->select(DB::raw('DATE(created_at) as date'), DB::raw('property_id, type'), DB::raw('count(*) as views'))
		->groupBy('date', 'type')
		->get();
		$data = [];
		foreach ($statistics as $key => $statistic) {
			$data[$statistic->date][$statistic->type] = $statistic->views;

		}

		return json_encode($data);

	}

	
	    
}