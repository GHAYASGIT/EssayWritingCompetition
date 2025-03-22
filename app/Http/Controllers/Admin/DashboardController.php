<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Events;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBookings = Booking::count();
        // Count users excluding admin users (which are in a separate table)
        $totalUsers = User::count();
        $totalEvents = Events::count();
        $totalFinishedEvents = Events::where('end_at', '<', Carbon::now())->count();

        return view('admin.dashboard', compact(
            'totalBookings',
            'totalUsers',
            'totalEvents',
            'totalFinishedEvents'
        ));
    }
}
