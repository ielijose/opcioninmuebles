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
                    /* Notification */
                    $noti = "Tiene un potencial cliente asignado.";
                    $n = new Notification([
                        'notification' => $noti, 
                        'type' => 'new_customer', 
                        'type_id' => $customer->id,
                        'user_id' => $admin->id, 
                        'sent_id' => Auth::user()->id
                        ]);
                    $n->save();

                    /* Email */

                    $data = ['recepcionista' => Auth::user()->full_name, 'sucursal' => $customer->branch->address, 'id' => $customer->id ,'cliente' => $customer->name .' '. $customer->lastname];

                    Mail::send('emails.notify.new-customer', $data, function($message) use ($admin)
                    {
                        $message->from('noreply@opcioninmuebles.com', 'Nuevo cliente asignado');
                        $message->to($admin->email, $admin->full_name)->subject('Nuevo cliente! - OpcionInmuebles.com');
                    });
                }
            }
           

        });

        static::deleted(function($customer)
        {   
            /* Notification */
            $notifications = Notification::customer($customer->id)->get();
            
            foreach ($notifications as $key => $notification) {
                $notification->delete();
            }

            $admins = User::admin()->get();
            foreach ($admins as $key => $admin) {                
                /* Email */
                $data = ['recepcionista' => Auth::user()->full_name, 'sucursal' => $customer->branch->address, 'id' => $customer->id ,'cliente' => $customer->name .' '. $customer->lastname];

                Mail::send('emails.notify.delete-customer', $data, function($message) use ($admin)
                {
                    $message->from('noreply@opcioninmuebles.com', 'Cliente eliminado');
                    $message->to($admin->email, $admin->full_name)->subject('Cliente eliminado! - OpcionInmuebles.com');
                });
            }

        });
    }

    /* Scopes */
    

    /* Relationships */

    public function branch()
    {
        return $this->belongsTo('Branch');
    }


    /* Function */

    public function assign($id)
    {
        $this->manager_id = $id;
        $this->estado = 'asignado';
        
        if($this->save()){
            $n = new Notification([
                'notification' => "Tiene un potencial cliente asignado.", 
                'type' => 'assigned', 
                'type_id' => $this->id,
                'user_id' => $this->manager_id, 
                'sent_id' => Auth::user()->id
                ]);
            $n->save();

            $manager = User::find($id);

            /* Email */

            $data = ['gm' => Auth::user()->full_name, 'id' => $this->id ,'cliente' => $this->name .' '. $this->lastname];

            Mail::send('emails.notify.assigned', $data, function($message) use ($manager)
            {
                $message->from('noreply@opcioninmuebles.com', 'Cliente asignado');
                $message->to($manager->email, $manager->full_name)->subject('Cliente asignado! - OpcionInmuebles.com');
            });
        }

    }

    public function negotiate($id)
    {
        $this->manager_id = $id;
        $this->estado = 'negociacion';
        
        if($this->save()){
            $n = new Notification([
                'notification' => "Tiene un potencial cliente asignado.", 
                'type' => 'assigned', 
                'type_id' => $this->id,
                'user_id' => $this->manager_id, 
                'sent_id' => Auth::user()->id
                ]);
            $n->save();

            $manager = User::find($id);

            /* Email */

            $data = ['gz' => Auth::user()->full_name, 'id' => $this->id ,'cliente' => $this->name .' '. $this->lastname];

            Mail::send('emails.notify.negotiation', $data, function($message) use ($manager)
            {
                $message->from('noreply@opcioninmuebles.com', 'Cliente para negociación');
                $message->to($manager->email, $manager->full_name)->subject('Cliente para negociación! - OpcionInmuebles.com');
            });
        }

    }

    public function finish($estado)
    {
        $this->estado = $estado;
        
        if($this->save()){
            /*$n = new Notification([
                'notification' => "Tiene un potencial cliente asignado.", 
                'type' => 'assigned', 
                'type_id' => $this->id,
                'user_id' => $this->manager_id, 
                'sent_id' => Auth::user()->id
                ]);
            $n->save();

            $manager = User::find($id);

            /* Email *

            $data = ['gz' => Auth::user()->full_name, 'id' => $this->id ,'cliente' => $this->name .' '. $this->lastname];

            Mail::send('emails.notify.negotiation', $data, function($message) use ($manager)
            {
                $message->from('noreply@opcioninmuebles.com', 'Cliente para negociación');
                $message->to($manager->email, $manager->full_name)->subject('Cliente para negociación! - OpcionInmuebles.com');
            });*/
        }

    }

    public function getEstado()
    {
        switch ($this->estado) {
            case 'prospecto':
                return '<a href="#" class="btn btn-primary pull-right m-20"> Prospecto </a>';
                break;

            case 'asignado':
                return '<a href="#" id="assigned" class="btn btn-success pull-right m-20"> Asignado </a>';
                break;

            case 'negociacion':
                return '<a href="#" id="negotiation" class="btn btn-info pull-right m-20"> En negociación </a>';
                break;
            
            default:
                # code...
                break;
        }
    }

    public function getEstadoLabel()
    {
        switch ($this->estado) {
            case 'prospecto':
                return '<span class="label label-primary">Prospecto</span>';
                break;

            case 'asignado':
                return '<span class="label label-success">Asignado</span>';
                break;

            case 'negociacion':
                return '<span class="label label-info">En negociación</span>';
                break;
            
            default:
                # code...
                break;
        }
    }

    

    public function scopeCurrent($query, $id)
    {
        return $query->where('branch_id', $id);
    }

    public function scopeEstado($query, $estado)
    {
        return $query->where('estado', $estado);
    } 
     
}