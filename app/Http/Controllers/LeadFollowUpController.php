<?php


namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Lead;
use App\Models\LeadFollowUp;
use Illuminate\Http\Request;

class LeadFollowUpController extends Controller
{

    public function store(Request $request, Lead $lead)
    {
        $request->validate(['calling_type' => 'required', 'status' => 'required', 'note' => 'required', 'follow_up_date' => 'nullable|date','follow_up_datetime'=>'nullable|date']);
        $data = ['calling_type' => $request->calling_type, 'status' => $request->status, 'note' => $request->note,];
        if ($request->filled('follow_up_date')) {
            $data['follow_up_date'] = Carbon::parse($request->follow_up_date);
        }

        if ($request->filled('follow_up_datetime')) {
            $data['follow_up_date'] = Carbon::parse($request->follow_up_datetime);
        }

        LeadFollowUp::updateOrCreate(['lead_id' => $lead->id], $data);
        return back()->with('success', 'Follow-up saved');
    }
}
