<?php

class Property extends Model {

    protected $table = 'properties';
    public $timestamp = true;

    protected $fillable = ['plattformCode','address','country_id', 'estate_id','city_id','zipcode',
    'description','stratus','image','valor_comercial','valor_oportunidad',];


	protected static $rules = [
        'plattformCode' => 'required',
		'address' => 'required',
		'country_id' => 'required',		
		'estate_id' => 'required',
		'city_id' => 'required',	
        'stratus' => 'required',
        'valor_comercial' => 'required',
        'valor_oportunidad' => 'required',
    ];

    //Use this for custom messages
    protected static $messages = [
        'plattformCode.required' => 'Campo obligatorio.',
        'address.required' => 'Campo obligatorio.',
        'country_id.required' => 'Campo obligatorio.',
        'estate_id.required' => 'Campo obligatorio.',        
        'city_id.required' => 'Campo obligatorio.',
        'stratus.required' => 'Campo obligatorio.', 
        'valor_comercial' => 'Campo obligatorio.',
        'valor_oportunidad' => 'Campo obligatorio.',
	];

    public static function boot()
    {
        parent::boot();
        static::deleting(function($property)
        {   
            if(File::exists( public_path() . $property->image )){
                Croppa::delete($property->image);
            }            
        });
    }

    /* Scopes */
    

    /* Relationships */
    public function country()
    {
        return $this->belongsTo('Country');
    }

    public function estate()
    {
        return $this->belongsTo('Estate');
    }

    public function city()
    {
        return $this->belongsTo('City');
    }

    /* Function */

    public function getImage($width = 100)
    {
        if($this->image){
            return Croppa::url($this->image, $width);
        }else{
            return Identicon::getImageDataUri($this->id, $width);            
        }
    }

    public function getImageAttribute()
    {
        if($this->attributes['image']){
            return Croppa::url($this->attributes['image'], 200);
        }else{
            return Identicon::getImageDataUri($this->attributes['id'], 200);            
        }
    }


    public function getStatistic($type)
    {
        $statistics = DB::table('statistics')
        ->select(DB::raw('type'), DB::raw('count(*) as views'))
        ->groupBy('type')
        ->where('property_id', $this->id)
        ->get();
        $val = 0;

        foreach ($statistics as $key => $sta) {
            if($sta->type == $type){
                $val = $sta->views;
            }
        }
        return json_encode($val); 
    }
    
}