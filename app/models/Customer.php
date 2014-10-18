<?php

class Customer extends Model {

    protected $table = 'customers';
    public $timestamp = true;

    protected $fillable = ['name','lastname','email','phone','code','estado','observation',
                            'category_id','city_id','portal_id','service_id', 'user_id', 'branch_id'];


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
        'branch_id' => 'required',
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
        'branch_id.required' => 'Campo obligatorio.',
    ];

    public static function boot()
    {
        parent::boot();
        static::created(function($customer)
        {   
            if($customer->service_id == 1){

                $admins = User::admin()->get();

                foreach ($admins as $key => $admin) {
                    $noti = "Tiene un potencial cliente asignado.";
                    $n = new Notification([
                        'notification' => $noti, 
                        'type' => 'new_customer', 
                        'type_id' => $customer->id,
                        'user_id' => $admin->id, 
                        'sent_id' => Auth::user()->id
                        ]);
                    $n->save();
                }
            }
           

        });
    }


    

    /* Scopes */
    

    /* Relationships */


    /* Function */


     
}