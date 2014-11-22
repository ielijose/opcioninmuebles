<?php

class Operator extends Model {

    protected $table = 'operators';
    public $timestamp = true;

    protected $fillable = ['full_name', 'username', 'password'];

    protected static $rules = [
        'full_name' => 'required',
        'username' => 'required',
        'password' => 'required',
    ];

    
    /* Scopes */
    

    /* Relationships */
   

    /* Function */


     
}