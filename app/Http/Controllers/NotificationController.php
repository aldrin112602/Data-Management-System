<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index()
    {
        // Retrieve the notifications for the authenticated user
        $notifications = DB::table('notifications')
            ->where('user_id', Auth()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('notifications', compact('notifications'));
    }
}
