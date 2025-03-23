<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\EventFeedback;
use App\Models\QuestionOptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EventFeedbackController extends Controller
{
    use AuthorizesRequests;

    private const FEEDBACK_WINDOW_DAYS = 7;

    public function store(Request $request, Events $event)
    {
        $this->validateFeedbackWindow($event);

        $request->validate([
            'rating'        => 'required|integer|between:1,5',
            'to_user_id'    => 'required|exists:users,id',
            'body'          => 'nullable|string|max:1000'
        ]);

        $feedback = EventFeedback::updateOrCreate(
            [
                'event_id'  => $event->id,
                'user_id'   => Auth::id()
            ],
            [
                'title'         => Auth::user()->name,
                'to_user_id'    => (int)$request->to_user_id,
                'rating'        => $request->rating,
                'body'          => $request->body,
            ]
        );

        return back()->with('success', 'Thank you for your feedback!');
    }

    public function update(Request $request, EventFeedback $feedback)
    {
        $this->authorize('update', $feedback);
        $this->validateFeedbackWindow($feedback->event);

        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'title' => 'nullable|string|max:255',
            'body' => 'nullable|string|max:1000'
        ]);

        $feedback->update($request->only(['rating', 'title', 'body']));

        return back()->with('success', 'Feedback updated successfully!');
    }

    private function validateFeedbackWindow(Events $event)
    {
        $feedbackDeadline = $event->end_at->copy()->addDays(self::FEEDBACK_WINDOW_DAYS);

        if (now()->gt($feedbackDeadline)) {
            abort(403, 'The feedback period for this event has ended.');
        }
    }

    public function getAverageRating(Events $event)
    {
        return $event->feedback()->avg('rating') ?? 0;
    }

    public function getTopEvents()
    {
        return Events::withAvg('feedback', 'rating')
            ->orderBy('feedback_avg_rating', 'desc')
            ->take(3)
            ->get();
    }

    public function edit(EventFeedback $feedback)
    {
        $this->authorize('update', $feedback);
        $this->validateFeedbackWindow($feedback->event);

        $topEvents = $this->getTopEvents();

        return view('event.show', [
            'event' => $feedback->event,
            'userFeedback' => $feedback,
            'topEvents' => $topEvents,
            'isEditing' => true
        ]);
    }

    public function show($eventId, $userId)
    {
        $event = Events::findOrFail($eventId); 
        $eventType = $event->getEventType();

        if($eventType == 'essay'){
            $essay_event = $event->getEssays($userId);
        }else{
            $essay_event = null;
        }
        
        if($eventType == 'mcqs'){
            $mcqs_event = $event->getMcqs($userId);
            $score = McqsController::calculateMcqsResult($mcqs_event);
        }else{
            $score = null;
        }

        return view('event.feedback', compact('event', 'userId', 'essay_event', 'score'));
    }
}