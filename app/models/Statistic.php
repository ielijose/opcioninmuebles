<?php

class Statistic extends Model {

    protected $table = 'statistics';
    public $timestamp = true;

    protected $fillable = ['type','ip','property_id'];


	protected static $rules = [
        'type' => 'required',
		'ip' => 'required',
		'property_id' => 'required',   
    ];

    /* Scopes */
    

    /* Relationships */


    /* Function */
    
}