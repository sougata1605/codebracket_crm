<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use App\Mail\LeadNotificationMail;
use App\Mail\LeadAcknowledgementMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        $assignedUsers = Lead::distinct()->pluck('assigned_user');

        return view('leads.index', compact('leads', 'users', 'assignedUsers'));
    }
}
