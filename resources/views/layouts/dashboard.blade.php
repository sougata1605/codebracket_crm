@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')


<h4 id="dynamicGreeting" class="mb-4">Welcome back 👋</h4>

<div class="row mb-4">

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h6>Total Leads</h6>
                <h3>{{ $totalLeads }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-warning">
            <div class="card-body text-center">
                <h6>Hot Leads</h6>
                <h3>{{ $hotLeads }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-success">
            <div class="card-body text-center">
                <h6>Converted</h6>
                <h3>{{ $convertedLeads }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-danger">
            <div class="card-body text-center">
                <h6>Not Interested</h6>
                <h3>{{ $notInterestedLeads }}</h3>
            </div>
        </div>
    </div>

</div>

<div class="card shadow-sm">
    <div class="card-header">
        <strong>Recent Leads</strong>
    </div>

    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Enquiry For</th>
                    <th>Lead Type</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentLeads as $lead)
                    <tr>
                        <td>{{ $lead->name }}</td>
                        <td>{{ $lead->phone }}</td>
                        <td>{{ $lead->enquiry_for }}</td>
                        <td>{{ $lead->lead_type }}</td>
                        <td>{{ $lead->status }}</td>
                        <td>{{ \Carbon\Carbon::parse($lead->lead_given_date)->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No leads found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection


<script>
document.addEventListener("DOMContentLoaded", function() {
    const element = document.getElementById('dynamicGreeting');
    const greetings = ["Welcome back 👋", "Clapping 👏", "Bye Bye 👋"];
    let index = 0;

    setInterval(function() {
        element.textContent = greetings[index];
        index = (index + 1) % greetings.length;
    }, 1000);
});
</script>