<?php

class Portal extends Model {

    protected $table = 'portals';
    public $timestamp = true;

    protected $fillable = ['portal'];
    
	protected static $rules = [
        'portal' => 'required'
    ];

    //Use this for custom messages
    protected static $messages = [
        'portal.required' => 'Campo obligatorio.',
    ];

    /* Scopes */
    

    /* Relationships */


    /* Function */


     
}