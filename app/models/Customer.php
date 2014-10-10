<?php

class Customer extends Model {

    protected $table = 'customers';
    public $timestamp = true;

    protected $fillable = ['name','lastname','email','phone','code','estado','observation','category_id','city_id','portal_id','service_id', 'user_id'];


	protected static $rules = [
        'name' => 'required',
		'lastname' => 'required',
		'email' => 'required',
		'phone' => 'required',
		'code' => 'required',
		'estado' => 'required',
        'category_id' => 'required',
        'city_id' => 'required',
        'portal_id' => 'required',
        'service_id' => 'required',
        'user_id' => 'required',
    ];

    //Use this for custom messages
    protected static $messages = [
        'name.required' => 'Campo obligatorio.',
        'lastname.required' => 'Campo obligatorio.',
        'email.required' => 'Campo obligatorio.',
        'phone.required' => 'Campo obligatorio.',
        'code.required' => 'Campo obligatorio.',
        'estado.required' => 'Campo obligatorio.',
        'category_id.required' => 'Campo obligatorio.',
        'city_id.required' => 'Campo obligatorio.',
        'portal_id.required' => 'Campo obligatorio.',
        'service_id.required' => 'Campo obligatorio.',
        'user_id.required' => 'Campo obligatorio.',
    ];

    /* Scopes */
    

    /* Relationships */


    /* Function */


     
}