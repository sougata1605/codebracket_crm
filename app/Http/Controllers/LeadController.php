<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use App\Mail\LeadNotificationMail;
use App\Mail\LeadAcknowledgementMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class LeadController extends Controller
{

    public function create()
    {
        return view('leads.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|max:255',
            'phone'           => 'required|digits:10',
            'enquiry_for'     => 'nullable|string|max:255',
            'address'         => 'nullable|string',
            'lead_type'       => 'required|in:Hot,Warm,Cold',
            'status'          => 'required|in:New,In Progress,Closed',
            'lead_given_date' => 'required|date|after_or_equal:today',
            'assigned_user'   => 'nullable|in:CRE,DSE',
        ]);


        $lead = Lead::create($validated);


        Mail::to('chatterjee2014@gmail.com')
            ->send(new LeadNotificationMail($lead));


        Mail::to($lead->email)
            ->send(new LeadAcknowledgementMail($lead));

        return redirect()
            ->route('leads.index')
            ->with('success', 'Lead saved successfully and emails sent');
    }

    public function index(Request $request)
    {
        $query = Lead::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('from_date')) {
            $query->whereDate('lead_given_date', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('lead_given_date', '<=', $request->to_date);
        }

        if ($request->filled('assigned_user')) {
            $query->where('assigned_user', $request->assigned_user);
        }


        $leads = $query->paginate(100);
        $users = User::all();
       
        $assignedUsers = Lead::whereNotNull('assigned_user')
    ->distinct()
    ->pluck('assigned_user');

        return view('leads.index', compact('leads', 'users', 'assignedUsers'));
    }


    public function notInterested()
    {
        $leads = DB::table('lead_follow_ups')
            ->join('leads', 'lead_follow_ups.lead_id', '=', 'leads.id')
            ->where('lead_follow_ups.status', 'Not Interested')
            ->select(
                'leads.name',
                'leads.phone',
                'leads.enquiry_for',
                'leads.assigned_user',
                'leads.lead_type',
                'lead_follow_ups.status as followup_status',
                'lead_follow_ups.follow_up_date'
            )
            ->orderBy('lead_follow_ups.follow_up_date', 'desc')
            ->get();

        return view('not_interested', compact('leads'));
    }


     function Converted()
     {
        $leads = DB::table('lead_follow_ups')
            ->join('leads', 'lead_follow_ups.lead_id', '=', 'leads.id')
            ->where('lead_follow_ups.status', 'Converted')
            ->select(
                'leads.name',
                'leads.phone',
                'leads.enquiry_for',
                'leads.assigned_user',
                'leads.lead_type',
                'lead_follow_ups.status as followup_status',
                'lead_follow_ups.follow_up_date'
            )
            ->orderBy('lead_follow_ups.follow_up_date', 'desc')
            ->get();

        return view('Converted', compact('leads'));
     }



function followup(){

$leads = DB::table('lead_follow_ups')
            ->join('leads', 'lead_follow_ups.lead_id', '=', 'leads.id')
            ->where('lead_follow_ups.status', 'In Progress')
            ->select(
                'leads.name',
                'leads.phone',
                'leads.enquiry_for',
                'leads.assigned_user',
                'leads.lead_type',
                'lead_follow_ups.status as followup_status',
                'lead_follow_ups.follow_up_date'
            )
            ->orderBy('lead_follow_ups.follow_up_date', 'desc')
            ->get();

        return view('followup', compact('leads'));





    
}








}
