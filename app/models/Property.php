<?php

class Property extends Model {

    protected $table = 'properties';
    public $timestamp = true;

    protected $fillable = ['plattformCode','address','country_id', 'estate_id','city_id','zipcode','description','stratus','image'];


	protected static $rules = [
        'plattformCode' => 'required',
		'address' => 'required',
		'country_id' => 'required',		
		'estate_id' => 'required',
		'city_id' => 'required',	
        'stratus' => 'required'        
    ];

    //Use this for custom messages
    protected static $messages = [
        'plattformCode.required' => 'Campo obligatorio.',
        'address.required' => 'Campo obligatorio.',
        'country_id.required' => 'Campo obligatorio.',
        'estate_id.required' => 'Campo obligatorio.',        
        'city_id.required' => 'Campo obligatorio.',
        'stratus.required' => 'Campo obligatorio.',            
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

    public function city()
    {
        return $this->belongsTo('City');
    }

    public function country()
    {
        return $this->belongsTo('Country');
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
}