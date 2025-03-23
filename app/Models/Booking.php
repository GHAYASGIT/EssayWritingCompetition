<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\McqsController;

class Booking extends Model
{
    /** @use HasFactory<\Database\Factories\BookingFactory> */
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bookings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'booking_no',
        'user_id',
        'event_id',
    ];

    public function user() : object {
        return $this->belongsTo(User::class);
    }

    public function event() : object {
        return $this->belongsTo(Events::class);
    }

    public function getMcqScore(Mcqs $mcq): float
    {
        return McqsController::calculateMcqsResult($mcq);
    }

}
