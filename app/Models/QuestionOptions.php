<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionOptions extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'question_options';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'event_id',
        'question',
        'options',
    ];
}
