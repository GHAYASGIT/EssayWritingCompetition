<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class Events extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'image',
        'subscribers',
        'description',
        'started_at',
        'end_at',
        'status',
    ];

    public function user() : object {
        return $this->belongsTo(Admin::class);
    }

    public function category() : object {
        return $this->belongsTo(Categories::class);
    }

    public function booking() : object {
        return $this->hasMany(Booking::class, 'event_id', 'id');
    }

    /**
     * get the events booking for the specific user
     *
     *
     * @param int $event_id
     * @return object|null
     **/
    public function getUserBookingByEventId(int $event_id = null)
    {
        if(Auth::check()){
            if(empty($event_id)){
                return 0;
            }else{
                try{
                    return Booking::where('user_id', Auth::user()->id)->where('event_id', $event_id)->firstOrFail();
                }catch(ModelNotFoundException $e){
                    return 0;
                }
            }
        }else{
            return 0;
        }
    }
}
