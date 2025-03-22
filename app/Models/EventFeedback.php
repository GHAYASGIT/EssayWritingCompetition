<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventFeedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'user_id',
        'rating',
        'title',
        'body',
        'to_user_id'
    ];

    protected $casts = [
        'rating' => 'integer'
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Events::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeWithinFeedbackWindow($query)
    {
        return $query->whereHas('event', function($q) {
            $q->where('end_at', '>=', now()->subDays(7));
        });
    }

    public function isEditable(): bool
    {
        return $this->event->end_at->addDays(7)->isFuture();
    }
}
