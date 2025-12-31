<div class="table-responsive table-scroll">
    <table class="table table-sm table-bordered align-middle mb-0">
        <thead class="table-light sticky-top">
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
                <td>{{ $lead->assigned_user }}</td>
                <td>{{ \Carbon\Carbon::parse($lead->lead_given_date)->format('d M Y') }}</td>
                <td>
                    <button class="btn btn-sm btn-info"
                            data-bs-toggle="modal"
                            data-bs-target="#lead{{ $lead->id }}">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No leads found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- MODALS --}}
@foreach($leads as $lead)
<div class="modal fade" id="lead{{ $lead->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Lead Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <table class="table table-bordered mb-4">
                    <tr><th>Name</th><td>{{ $lead->name }}</td></tr>
                    <tr><th>Phone</th><td>{{ $lead->phone }}</td></tr>
                    <tr><th>Enquiry</th><td>{{ $lead->enquiry_for ?? '-' }}</td></tr>
                    <tr><th>Assigned</th><td>{{ $lead->assigned_user }}</td></tr>
                </table>

                <form method="POST" action="{{ route('lead-follow-ups.store', $lead->id) }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">Calling Type</label><br>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input calling-type"
                                   type="radio"
                                   name="calling_type"
                                   value="Call Done"
                                   data-require-date="no">
                            <label class="form-check-label">Call Done</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input calling-type"
                                   type="radio"
                                   name="calling_type"
                                   value="Follow Up"
                                   data-require-date="date">
                            <label class="form-check-label">Follow Up</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input calling-type"
                                   type="radio"
                                   name="calling_type"
                                   value="Visit"
                                   data-require-date="datetime">
                            <label class="form-check-label">Visit</label>
                        </div>
                    </div>

                    <div class="mb-3 d-none followup-date">
                        <label class="form-label fw-bold">Follow-up Date</label>
                        <input type="date" name="follow_up_date" class="form-control">
                    </div>

                    <div class="mb-3 d-none followup-datetime">
                        <label class="form-label fw-bold">Visit Date & Time</label>
                        <input type="datetime-local" name="follow_up_datetime" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="">Select</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Not Interested">Not Interested</option>
                            <option value="Converted">Converted</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Note</label>
                        <textarea name="note" class="form-control" rows="3" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-success w-100">
                        Save Follow-up
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
@endforeach

<script>
document.addEventListener('change', function (e) {
    if (!e.target.classList.contains('calling-type')) return;

    const modal = e.target.closest('.modal-body');

    modal.querySelector('.followup-date').classList.add('d-none');
    modal.querySelector('.followup-datetime').classList.add('d-none');

    const type = e.target.dataset.requireDate;

    if (type === 'date') {
        modal.querySelector('.followup-date').classList.remove('d-none');
    }

    if (type === 'datetime') {
        modal.querySelector('.followup-datetime').classList.remove('d-none');
    }
});
</script>
