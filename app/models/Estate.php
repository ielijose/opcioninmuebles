<?php

class Estate extends Model {

    protected $table = 'estates';
    public $timestamp = true;

    protected $fillable = ['name', 'country_id'];

	protected static $rules = [
        'name' => 'required|unique:estates',
        'country_id' => 'required',
    ];

    //Use this for custom messages
    protected static $messages = [
        'name.required' => 'El nombre es obligatorio.',
        'name.unique' => 'El nombre no puede estar repetido.',
    ];

    /* Scopes */
    

    /* Relationships */

    public function cities()
    {
        return $this->hasMany('City');
    }


    /* Function */


     
}