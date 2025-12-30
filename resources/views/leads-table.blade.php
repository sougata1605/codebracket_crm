<table class="table table-sm table-bordered align-middle">
    <thead class="table-light">
        <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>Enquiry For</th>
            <th> Lead Given </th>
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
            <td>{!! $lead->assigned_user  !!} </td>
            <td>{{ \Carbon\Carbon::parse($lead->lead_given_date)->format('d M Y') }}</td>
            <td>
                <button class="btn btn-sm btn-info"
                        data-bs-toggle="modal"
                        data-bs-target="#lead{{ $lead->id }}">
                    <i class="fa-sharp fa-solid fa-eye"></i>
                </button>
            </td>
        </tr>

        <div class="modal fade" id="lead{{ $lead->id }}">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>{{ $lead->name }}</h5>
                    </div>
                    <div class="modal-body">
                        @forelse($lead->activities as $a)
                            <p><b>Call Type:</b> {{ $a->calling_type }}</p>
                            <p><b>Status:</b> {{ $a->status }}</p>
                            <p><b>Note:</b> {{ $a->note }}</p>
                            <hr>
                        @empty
                            <p class="text-muted">No follow-up yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        @empty
        <tr>
            <td colspan="5" class="text-center">No leads found</td>
        </tr>
        @endforelse
    </tbody>
</table>
