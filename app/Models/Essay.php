<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Essay extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'essays';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'event_id',
        'content',
        'is_drafted',
        'is_submitted',
    ];
}
