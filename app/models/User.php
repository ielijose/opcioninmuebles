<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Carbon\Carbon;


class User extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    protected $fillable = ['full_name', 'email', 'password', 'type', 'profile_picture'];

    public static $rules = [
    'full_name' => 'required',
    'email' => 'required|email|unique:users',
    'password' => 'required|min:4',
    'type' => 'required',
    ];

    //Use this for custom messages
    public static $messages = [
    'full_name.required' => 'El nombre es obligatorio.',
    'email.required' => 'El correo es obligatorio.',
    'email.email' => 'Formato de correo invalido.',
    'email.unique' => 'El correo ya esta registrado en nuestra base de datos.',
    'password.required' => 'La contraseña es obligatoria.',
    'password.confirmed' => 'Las contraseñas deben coincidir.',
    'password_confirmation.required' => 'La confirmación de contraseña es obligatoria.',
    'type.required' => 'El plan es obligatorio.',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function($user)
        {   
            
            if(!$user->password){
                $p = str_random(8);
                $user->password = $p;
            }
                
            $pa = (isset($p)) ? $p : $user->password;

            $data = ['name' => $user->full_name, 'email' => $user->email, 'password' => $pa ,'url' => 'http://opcioninmuebles.com/admin/'];

            Mail::send('emails.auth.registration', $data, function($message) use ($user)
            {
                $message->from('noreply@opcioninmuebles.com', 'Registro de usuario');
                $message->to($user->email, $user->full_name)->subject('Registro! - OpcionInmuebles.com');
            });

        });

        static::deleting(function($user)
        {   
            if(File::exists( public_path() . $user->profile_picture )){
                Croppa::delete($user->profile_picture);
               // File::delete(   ); 
            }
            
            
        });

    }

    public function setPasswordAttribute($value)
    {
        if ( ! empty ($value))
        {
            if (Hash::needsRehash($value))
            {
                $this->attributes['password'] = \Hash::make($value);
            }else{
                $this->attributes['password'] = $value; 
            }
        }
    }   

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    /* Functions */

    public function name(){
        return explode( ' ', $this->full_name)[0];
    }

    public function getTypeName(){
        switch ($this->type) {
            case 'GeneralManager':
            return "(General Manager)";
            break;   

            case 'ManagerZone':
            return "(Manager Zone)";
            break;

            case 'Agent':
            return "(Agent)";
            break;

            case 'Receptionist':
            return "(Receptionist)";
            break;      
            
        }
    }

    /* ---------- */
    
    public function getHumanDate()
    {
        $txt = 'carbon.timediff.';
        $isNow = true;
        $other = Carbon::now();
        $delta = abs($other->diffInSeconds($this->created_at));

        $divs = array(
         'second' => Carbon::SECONDS_PER_MINUTE,
         'minute' => Carbon::MINUTES_PER_HOUR,
         'hour'   => Carbon::HOURS_PER_DAY,
         'day'    => 30,
         'month'  => Carbon::MONTHS_PER_YEAR
         );

        $unit = 'year';
        foreach ($divs as $divUnit => $divValue) {
            if ($delta < $divValue) {
                $unit = $divUnit;
                break;
            }

            $delta = floor($delta / $divValue);
        }

        if ($delta == 0) {
            $delta = 1;
        }

        $txt .= $unit;
        return Lang::choice($txt, $delta, compact('delta'));
    }

    public function getProfilePicture()
    {
        if($this->profile_picture){
            return Croppa::url($this->profile_picture,200);
        }else{
            return Identicon::getImageDataUri($this->id, 200);            
        }
    }
}