<?php

class Branch extends Model {

    protected $table = 'branches';
    public $timestamp = true;

    protected $fillable = ['address', 'country_id', 'estate_id', 'city_id', 'zipcode', 'phone'];


	protected static $rules = [
        'address' => 'required',
		'country_id' => 'required',
		'estate_id' => 'required',
		'city_id' => 'required',
		'zipcode' => 'required',
		'phone' => 'required',
    ];

    //Use this for custom messages
    protected static $messages = [
        'address.required' => 'Campo obligatorio.',
        'country_id.required' => 'Campo obligatorio.',
        'estate_id.required' => 'Campo obligatorio.',
        'city_id.required' => 'Campo obligatorio.',
        'zipcode.required' => 'Campo obligatorio.',
        'phone.required' => 'Campo obligatorio.',
    ];

    /* Scopes */
    

    /* Relationships */

    public function city()
    {
        return $this->belongsTo('City');
    }


    /* Function */


     
}