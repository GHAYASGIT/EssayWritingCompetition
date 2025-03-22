<?php

namespace App\Providers;

use App\Models\EventFeedback;
use App\Policies\EventFeedbackPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        EventFeedback::class => EventFeedbackPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}