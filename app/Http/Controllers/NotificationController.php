<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index()
    {
        return view('user.notification.index');
    }

    public function getNotif(Request $request) {
        // Get user_id from the request
        $userId = $request->input('user_id');

        // Retrieve the notifications for the authenticated user
        $notifications = DB::table('notifications')
            ->where('user_id', $userId) // Use the retrieved user_id
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($notifications);
    }
}
