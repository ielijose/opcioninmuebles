<?php

class Customer extends Model {

    protected $table = 'customers';
    public $timestamp = true;

    protected $fillable = ['plattformCode','address','country_id', 'estate_id','city_id','zipcode','description','stratus','image'];


	protected static $rules = [
        'plattformCode' => 'required',
		'address' => 'required',
		'country_id' => 'required',		
		'estate_id' => 'required',
		'city' => 'required',	
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

    /* Scopes */
    

    /* Relationships */


    /* Function */
}