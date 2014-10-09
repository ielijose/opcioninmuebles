<?php

class Customer extends Model {

    protected $table = 'customers';
    public $timestamp = true;

    protected $fillable = ['numcli','name','lastname','phone','email','slug'];
    
	protected static $rules = [
        'numcli' => 'required',
		'name' => 'required',
		'lastname' => 'required',
		'phone' => 'required',
		'email' => 'required',
		'slug' => 'required',
    ];

    //Use this for custom messages
    protected static $messages = [
        'numcli.required' => 'Campo obligatorio.',
        'name.required' => 'Campo obligatorio.',
        'lastname.required' => 'Campo obligatorio.',
        'phone.required' => 'Campo obligatorio.',
        'email.required' => 'Campo obligatorio.',
        'slug.required' => 'Campo obligatorio.',
    ];

    /* Scopes */
    

    /* Relationships */


    /* Function */


     
}