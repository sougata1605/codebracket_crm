@extends('layouts.app')

@section('title', 'Followup Leads')

@section('content')

<h4 class="mb-4 text-primary fw-bold">
    <i class="fa-solid fa-phone-volume me-2"></i>
    FollowUp  Leads
</h4>

<table class="table table-sm table-bordered align-middle">
    <thead class="table-light">
        <tr>
            <th>Name</th>
            <th>Ph No</th>
            <th>Enquiry For</th>
            <th>Lead Given</th>
            <th>Lead Type</th>
            <th>Lead Status</th>
            <th>Date</th>
        </tr>
    </thead>

    <tbody>
        @forelse($leads as $lead)
        <tr>
            <td>{{ $lead->name }}</td>
            <td>{{ $lead->phone }}</td>
            <td>{{ $lead->enquiry_for ?? '-' }}</td>
            <td>{{ $lead->assigned_user }}</td>
            <td>
                <span class="badge bg-info text-primary">
                    {{ $lead->lead_type }}
                </span>
            </td>
            <td>
                <span class="badge bg-primary">
                    {{ $lead->followup_status }}
                </span>
            </td>
            <td>{{ \Carbon\Carbon::parse($lead->follow_up_date)->format('d M Y') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center text-muted">
                No Follow up  Leads Found
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection
