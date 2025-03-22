<?php

namespace App\Policies;

use App\Models\EventFeedback;
use App\Models\User;

class EventFeedbackPolicy
{
    public function update(User $user, EventFeedback $feedback): bool
    {
        return $feedback->user_id === $user->id && $feedback->isEditable();
    }

    public function edit(User $user, EventFeedback $feedback): bool
    {
        return $this->update($user, $feedback);
    }
}
