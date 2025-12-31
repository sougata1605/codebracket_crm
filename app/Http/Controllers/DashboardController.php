<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Lead;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLeads = Lead::count();

        $weeklyLeads = Lead::whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ])->count();

        $hotLeads  = Lead::where('lead_type', 'Hot')->count();
        $warmLeads = Lead::where('lead_type', 'Warm')->count();
        $coldLeads = Lead::where('lead_type', 'Cold')->count();

        $todayLeads = Lead::select('id','name','phone','enquiry_for','assigned_user','lead_given_date')
            ->with('activities')
            ->whereDate('lead_given_date', Carbon::today())
            ->get();

        $tomorrowLeads = Lead::select('id','name','phone','enquiry_for','assigned_user','lead_given_date')
            ->with('activities')
            ->whereDate('lead_given_date', Carbon::yesterday())
            ->get();

        return view('dashboard', compact(
            'totalLeads',
            'weeklyLeads',
            'hotLeads',
            'warmLeads',
            'coldLeads',
            'todayLeads',
            'tomorrowLeads'
        ));
    }
}
