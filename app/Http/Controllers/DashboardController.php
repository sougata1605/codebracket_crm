<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $tomorrow = Carbon::tomorrow();
        $weekStart = Carbon::now()->startOfWeek();

        return view('dashboard.index', [
            'totalLeads'   => Lead::count(),
            'weeklyLeads'  => Lead::where('created_at', '>=', $weekStart)->count(),

            'hotLeads'  => Lead::where('lead_type', 'Hot')->count(),
            'warmLeads' => Lead::where('lead_type', 'Warm')->count(),
            'coldLeads' => Lead::where('lead_type', 'Cold')->count(),

            'todayLeads'    => Lead::whereDate('lead_given_date', $today)->get(),
            'tomorrowLeads' => Lead::whereDate('lead_given_date', $tomorrow)->get(),
        ]);
    }
}

