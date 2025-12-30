@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="card">
    <div class="card-header">
        <h5>Lead Listing</h5>
    </div>

    <div class="card-body">

        <form method="GET" action="{{ route('leads.index') }}" class="mb-3 row g-2">
            <div class="col-md-4">
                <input type="text" name="name" class="form-control" placeholder="Search by Name" value="{{ request('name') }}">
            </div>
            <div class="col-md-3">
                <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
            </div>
            <div class="col-md-3">
                <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
            </div>
            <div class="col-md-2">
                <select name="assigned_user" class="form-select">
                    <option value="">All Assigned</option>
                    @foreach($assignedUsers as $assigned)
                    <option value="{{ $assigned }}"
                        {{ request('assigned_user') == $assigned ? 'selected' : '' }}>
                        {{ $assigned }}
                    </option>
                    @endforeach

                </select>
            </div>
            <div class="col-md-12 mt-2">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('leads.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>


        <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Lead Type</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Assigned</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($leads as $lead)
                    <tr>
                        <td>{{ $lead->name }}</td>
                        <td>{{ $lead->phone }}</td>
                        <td>{{ $lead->enquiry_for }}</td>
                        <td>{{ $lead->lead_type }}</td>
                        <td>{{ $lead->status }}</td>
                        <td>{{ \Carbon\Carbon::parse($lead->lead_given_date)->format('d M Y') }}</td>
                         <td>{{ $lead->assigned_user }}</td>
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
</div>

@endsection