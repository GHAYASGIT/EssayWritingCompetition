<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use App\Models\EventFeedback;

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

    protected $casts = [
        'started_at' => 'datetime',
        'end_at' => 'datetime'
    ];

    protected static function boot()
    {
        parent::boot();

        static::retrieved(function ($event) {
            if ($event->status === 'active' && $event->end_at < now()) {
                $event->status = 'inactive';
                $event->save();
            }
        });
    }

    public function feedback() : object
    {
        return $this->hasMany(EventFeedback::class, 'event_id', 'id');
    }

    /**
     * Get the user that owns the Event
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
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
     * @param int|null $event_id
     * @return object|null
     **/
    public function getUserBookingByEventId(?int $event_id = null)
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

    /**
     * get essay is drafted by event id
     *
     * @param int|null $event_id
     * @param int|null $category_id
     * @return object|null
     **/
    public function eventIsDrafted(?int $event_id = null, ?int $category_id = null)
    {
        if(Auth::check()){
            if(empty($event_id)){
                return 0;
            }else{
                try{
                    switch($category_id){
                        case '1':
                            return Essay::where('user_id', Auth::user()->id)->where('event_id', $event_id)->firstOrFail();
                            break;
                        case '2':
                            return Mcqs::where('user_id', Auth::user()->id)->where('event_id', $event_id)->firstOrFail();
                            break;
                        default:
                            return 0;
                            break;
                    }

                }catch(ModelNotFoundException $e){
                    return 0;
                }
            }
        }else{
            return 0;
        }
    }

    /**
     * Get MCQs associated with the specific event.
     *
     * @return \Illuminate\Database\Eloquent\Collection|null
     **/
    public function getMcqs(?int $user_id = null)
    {
        if(empty($user_id)){
            return $this->hasMany(Mcqs::class, 'event_id')->get();
        }else{
            try{
                return $this->hasMany(Mcqs::class, 'event_id')->where('user_id', $user_id)->firstOrFail();
            }catch(ModelNotFoundException $e){
                return null;
            }
        }
    }

    /**
     * Get Essays associated with the specific event.
     *
     * @return \Illuminate\Database\Eloquent\Collection|null
     **/
    public function getEssays(?int $user_id = null)
    {
        if(empty($user_id)){
            return $this->hasMany(Essay::class, 'event_id')->get();
        }else{
            try{
                return $this->hasMany(Essay::class, 'event_id')->where('user_id', $user_id)->firstOrFail();
            }catch(ModelNotFoundException $e){
                return null;
            }
        }
    }

    public function getEventType(){
        switch (strtolower($this->category()->first()->name)) {
            case 'essay':
                return 'essay';
                break;
            case 'mcqs':
                return 'mcqs';
                break;
            default:
                return null;
        }
    }

    public function getIsSubmitted(int $user_id )
    {
        switch (strtolower($this->category()->first()->name)) {
            case 'essay':
                if(empty($this->getEssays($user_id))){
                    return null;
                }else{
                    return $this->getEssays($user_id)->is_submitted;
                }
                break;

            case 'mcqs':
                if(empty($this->getMcqs($user_id))){
                    return null;
                }else{
                    return $this->getMcqs($user_id)->is_submitted;
                }
                break;

            default:
                return null;
                break;
        }
    }

}
