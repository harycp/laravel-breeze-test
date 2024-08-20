<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke(Request $request){
        return view("dashboard");
    }

    public function index()
    {
        $attendance = Attendance::where('user_id', Auth::id())
            ->whereDate('created_at', now()->format('Y-m-d'))
            ->first();
    
        $attendances = Attendance::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
    
        return view('dashboard', compact('attendance', 'attendances'));
    }
    
}
