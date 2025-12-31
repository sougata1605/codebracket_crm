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
            'follow_up_date' => 'nullable|date',
        ]);

        $data = [
            'calling_type' => $request->calling_type,
            'status' => $request->status,
            'note' => $request->note,
        ];


        if ($request->filled('follow_up_date')) {
            $data['follow_up_date'] = $request->follow_up_date;
        }

        LeadFollowUp::updateOrCreate(
            ['lead_id' => $lead->id],
            $data
        );

        return back()->with('success', 'Follow-up saved');
    }
}
