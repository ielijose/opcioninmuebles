<?php
use Carbon\Carbon;

class Notification extends Model {

    protected $table = 'notifications';
    public $timestamp = true;

    protected $fillable = ['notification', 'type', 'type_id', 'sent_id', 'user_id'];

    protected static $rules = [
    'notification' => 'required',
    'type' => 'required',
    'user_id' => 'required',
    ];

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function scopeUnread($query)
    {
        return $query->where('is_read', '=', 0)->where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC');
    } 

    public function getClass()
    {
        switch ($this->type) {
            case 'question':
            return "fa-question c-blue";
            break;
            
            default:
                # code...
            break;
        }
    }

    public function getIcon(){
        if($this->sent_id){
            return '<img src="' . User::find($this->sent_id)->getProfilePicture() .  '" alt="">';
        }else{
            return '<i class="fa p-r-10 f-18 '. $this->getClass() .'"></i>';
        }
    }

    public function getLink()
    {
        switch ($this->type) {
            case 'question':
            return "/panel/question/" . $this->type_id . "?ref=notify&n=" . $this->id;
            break;

            case 'new_customer':
            return "/customer/" . $this->type_id . "?ref=notify&n=" . $this->id;
            break;
            
            default:
                # code...
            break;
        }
    }

    public function getReminder(){
        if($this->sent_id){
            return '<strong>' . User::find($this->sent_id)->full_name .  '</strong>';
        }
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

    public function read()
    {
        $this->is_read = 1;
        return $this->save();
    }

}