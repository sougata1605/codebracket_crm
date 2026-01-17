<?php

namespace App\Http\Controllers;

use App\Jobs\SendInterviewFeedbackEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InterviewFeedbackController extends Controller
{
    public function scheduleEmails(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'hr_name' => 'required|string',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
        'interval' => 'required|integer'
    ]);

    $email = $request->email;
    $hrName = $request->hr_name;
    $intervalMinutes = (int) $request->interval;

    $start = Carbon::parse($request->start_date);
    $end   = Carbon::parse($request->end_date);

    
    if ($start->lessThan(Carbon::now())) {
        $start = Carbon::now()->addMinutes($intervalMinutes);
    }

    while ($start->lte($end)) {

        
        SendInterviewFeedbackEmail::dispatch($email, $hrName)
            ->delay($start->copy());

        
        $start->addMinutes($intervalMinutes);
    }

    return redirect()->back()->with('success', 'Emails scheduled successfully!');
}
}
