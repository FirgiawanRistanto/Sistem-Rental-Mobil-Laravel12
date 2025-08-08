<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NotifController extends Controller
{
    public function markAsRead(Request $request, $notificationId)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $notification = $user->notifications()->where('id', $notificationId)->first();

        if ($notification) {
            $notification->markAsRead();
            Log::info("Notification {$notificationId} marked as read for user {$user->id}.");
            return response()->json(['message' => 'Notification marked as read']);
        }

        return response()->json(['message' => 'Notification not found'], 404);
    }
}