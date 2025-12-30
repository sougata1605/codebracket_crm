<?php 


namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\LeadFollowUp;
use Illuminate\Http\Request;

class LeadFollowUpController extends Controller
{
    public function store(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'note' => 'required|string',
            'calling_type' => 'required|array',
            'status' => 'required|in:In Progress,Not Interested,Converted',
            'follow_up_date' => 'nullable|date',
        ]);

        foreach($validated['calling_type'] as $type) {
            $lead->activities()->create([
                'calling_type' => $type,
                'note' => $validated['note'],
                'status' => $validated['status'],
                'follow_up_date' => $validated['follow_up_date'] ?? now(),
            ]);
        }

        return back()->with('success','Follow-up added successfully');
    }
}
