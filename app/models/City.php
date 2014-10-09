<?php

class City extends Model {

    protected $table = 'cities';
    public $timestamp = true;

    protected $fillable = ['name'];

	protected static $rules = [
        'name' => 'required|unique:cities',
    ];

    //Use this for custom messages
    protected static $messages = [
        'name.required' => 'El nombre es obligatorio.',
        'name.unique' => 'El nombre no puede estar repetido.',
    ];

    /* Scopes */
    

    /* Relationships */


    /* Function */


     
}