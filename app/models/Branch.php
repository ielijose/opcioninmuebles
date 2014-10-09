<?php

class Branch extends Model {

    protected $table = 'branches';
    public $timestamp = true;

    protected $fillable = ['sucursalId','street','city','state','zipcode','country','phone'];
    
	protected static $rules = [
        'sucursalId' => 'required',
		'street' => 'required',
		'city' => 'required',
		'state' => 'required',
		'zipcode' => 'required',
		'country' => 'required',
		'phone' => 'required',
    ];

    //Use this for custom messages
    protected static $messages = [
        'sucursalId.required' => 'Campo obligatorio.',
        'street.required' => 'Campo obligatorio.',
        'city.required' => 'Campo obligatorio.',
        'state.required' => 'Campo obligatorio.',
        'zipcode.required' => 'Campo obligatorio.',
        'country.required' => 'Campo obligatorio.',
        'phone.required' => 'Campo obligatorio.',
    ];

    /* Scopes */
    

    /* Relationships */


    /* Function */


     
}