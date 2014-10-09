<?php

class Category extends Model {

    protected $table = 'categories';
    public $timestamp = true;

    protected $fillable = ['category'];
    
	protected static $rules = [
        'category' => 'required'
    ];

    //Use this for custom messages
    protected static $messages = [
        'category.required' => 'Campo obligatorio.'
    ];

    /* Scopes */
    

    /* Relationships */


    /* Function */


     
}