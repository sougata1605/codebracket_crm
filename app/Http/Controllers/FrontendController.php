<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;
use Carbon\Carbon;
use App\Models\LeadFollowUp;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    
    public function dashboard()
    {
    
        $totalLeads = Lead::count();

        $weeklyLeads = Lead::whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ])->count();

        $hotLeads  = Lead::where('lead_type', 'Hot')->count();
        $warmLeads = Lead::where('lead_type', 'Warm')->count();
        $coldLeads = Lead::where('lead_type', 'Cold')->count();

        
        $todayLeads = Lead::with('activities')
            ->whereDate('lead_given_date', Carbon::today())
            ->get();

        $tomorrowLeads = Lead::with('activities')
            ->whereDate('lead_given_date', Carbon::tomorrow())
            ->get();

        
        $latestFollowUps = DB::table('lead_follow_ups as lf')
            ->join('leads as l', 'lf.lead_id', '=', 'l.id')
            ->select('lf.lead_id', 'lf.status')
            ->whereIn('lf.status', ['Converted', 'In Progress', 'Not Interested'])
            ->whereRaw('lf.id = (SELECT MAX(id) FROM lead_follow_ups WHERE lead_id = lf.lead_id)')
            ->get()
            ->groupBy('status')
            ->map(function ($group) {
                return count($group);
            });

        
        $followUpLeadsChartData = [
            'Converted' => $latestFollowUps['Converted'] ?? 0,
            'In Progress' => $latestFollowUps['In Progress'] ?? 0,
            'Not Interested' => $latestFollowUps['Not Interested'] ?? 0,
        ];

        
        return view('frontend.dashboard', compact(
            'totalLeads',
            'weeklyLeads',
            'hotLeads',
            'warmLeads',
            'coldLeads',
            'todayLeads',
            'tomorrowLeads',
            'followUpLeadsChartData'
        ));
    } 



}










