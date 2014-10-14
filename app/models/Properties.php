<?php

class Customer extends Model {

    protected $table = 'customers';
    public $timestamp = true;

    protected $fillable = ['plattformCode','address','country_id', 'estate_id','city_id','zipcode','description','status','image'];


	protected static $rules = [
        'plattformCode' => 'required',
		'address' => 'required',
		'country_id' => 'required',		
		'estate_id' => 'required',
		'city' => 'required',	
        'status' => 'required'        
    ];

    //Use this for custom messages
    protected static $messages = [
        'plattformCode.required' => 'Campo obligatorio.',
        'address.required' => 'Campo obligatorio.',
        'country_id.required' => 'Campo obligatorio.',
        'estate_id.required' => 'Campo obligatorio.',        
        'city_id.required' => 'Campo obligatorio.',
        'status.required' => 'Campo obligatorio.',            
	];

    /* Scopes */
    

    /* Relationships */


    /* Function */
}