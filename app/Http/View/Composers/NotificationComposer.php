<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class NotificationComposer
{
    public function compose(View $view)
    {
        if (Auth::check()) {
            $unreadNotifications = Auth::user()->unreadNotifications;
            $view->with('unreadNotifications', $unreadNotifications);
        }
    }
}
