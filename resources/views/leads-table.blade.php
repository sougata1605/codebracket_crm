<table class="table table-sm table-bordered align-middle">
    <thead class="table-light">
        <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>Enquiry For</th>
            <th>Lead Given</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($leads as $lead)
        <tr>
            <td>{{ $lead->name }}</td>
            <td>{{ $lead->phone }}</td>
            <td>{{ $lead->enquiry_for ?? '-' }}</td>
            <td>{!! $lead->assigned_user !!}</td>
            <td>{{ \Carbon\Carbon::parse($lead->lead_given_date)->format('d M Y') }}</td>
            <td>
                <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#lead{{ $lead->id }}">
                    <i class="fa-solid fa-eye"></i>
                </button>
            </td>
        </tr>

        <!-- Modal -->
        <div class="modal fade" id="lead{{ $lead->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>{{ $lead->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <h6>Follow-ups</h6>
                        @forelse($lead->activities as $a)
                            <p><b>Call Type:</b> {{ $a->calling_type }}</p>
                            <p><b>Status:</b> {{ $a->status }}</p>
                            <p><b>Note:</b> {{ $a->note }}</p>
                            <p><b>Follow-up Date:</b> {{ $a->follow_up_date }}</p>
                            <hr>
                        @empty
                            <p class="text-muted">No follow-up yet.</p>
                        @endforelse

                        <h6 class="mt-3">Add Follow-up</h6>
                        <form action="{{ route('lead-follow-ups.store', $lead->id) }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Calling Type</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input calling-type" type="checkbox" name="calling_type[]" value="Call Done" data-type="date">
                                    <label class="form-check-label">Call Done</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input calling-type" type="checkbox" name="calling_type[]" value="Follow Up" data-type="date">
                                    <label class="form-check-label">Follow Up</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input calling-type" type="checkbox" name="calling_type[]" value="Visit" data-type="datetime">
                                    <label class="form-check-label">Visit</label>
                                </div>
                            </div>

                            <div class="mb-3 date-input d-none">
                                <label class="form-label">Follow-up Date / DateTime</label>
                                <input type="text" name="follow_up_date" class="form-control" id="follow_up_date_{{ $lead->id }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="">Select Status</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Not Interested">Not Interested</option>
                                    <option value="Converted">Converted</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Note</label>
                                <textarea name="note" class="form-control" rows="3" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Add Follow-up</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @empty
        <tr>
            <td colspan="6" class="text-center">No leads found</td>
        </tr>
        @endforelse
    </tbody>
</table>
