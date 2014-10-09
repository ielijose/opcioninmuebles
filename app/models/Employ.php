<?php
use Carbon\Carbon;
class Employ extends Model {

    protected $table = 'employs';
    public $timestamp = true;

    protected $fillable = ['employ', 'salary', 'place', 'description', 'horary', 'user_id'];

	protected static $rules = [
        'employ' => 'required',
        'salary' => 'required',
        'place' => 'required',
        'description' => 'required',
        'horary' => 'required',
    ];

    //Use this for custom messages
    protected static $messages = [
        'employ.required' => 'La categoria es obligatorio.',
        'salary.required' => 'La clase es obligatoria.',
        'description.required' => 'La clase es obligatoria.',
    ];

    /* Scopes */
    public function scopeCurrent($query)
    {
        return $query->where('user_id', '=', Auth::user()->id);
    }

    /* Relationships */


    public function categories()
    {
        return $this->belongsToMany('Category', 'employs_categories');
    }

    public function knowledges()
    {
        return $this->hasMany('Knowledge');
    }

    /* function */

    public function hasCategory($id)
    {
        $cats = $this->categories;
        foreach ($cats as $key => $c) {
            if($id == $c->id){
                return true;
            }
        }
        return false;
    }

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

    public function getName(){
        return substr($this->image, 17);
    }  
}