<?php

class Service extends Model {

    protected $table = 'services';
    public $timestamp = true;

    protected $fillable = ['service'];
    
	protected static $rules = [
        'service' => 'required'
    ];

    //Use this for custom messages
    protected static $messages = [
        'service.required' => 'Campo obligatorio.'
    ];

    /* Scopes */
    

    /* Relationships */


    /* Function */


     
}