<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
