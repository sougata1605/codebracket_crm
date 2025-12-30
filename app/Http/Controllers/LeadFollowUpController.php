<?php


namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\LeadFollowUp;
use Illuminate\Http\Request;

class LeadFollowUpController extends Controller
{
    public function store(Request $request, Lead $lead)
    {
        $request->validate([
            'calling_type' => 'required',
            'status' => 'required',
            'note' => 'required',
        ]);

        LeadFollowUp::create([
            'lead_id' => $lead->id,
            'calling_type' => $request->calling_type,
            'status' => $request->status,
            'note' => $request->note,
            'follow_up_date' => $request->follow_up_date ?? $request->follow_up_datetime,
        ]);

        return back()->with('success', 'Follow-up saved');
    }
}
