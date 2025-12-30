<h3>New Lead Entry</h3>

<p>A new lead has been submitted with the following details:</p>

<ul>
    <li><strong>Name:</strong> {{ $lead->name }}</li>
    <li><strong>Email:</strong> {{ $lead->email }}</li>
    <li><strong>Phone:</strong> {{ $lead->phone }}</li>
    <li><strong>Enquiry For:</strong> {{ $lead->enquiry_for ?? '-' }}</li>
    <li><strong>Lead Type:</strong> {{ $lead->lead_type }}</li>
    <li><strong>Status:</strong> {{ $lead->status }}</li>
    <li><strong>Date:</strong> {{ $lead->lead_given_date }}</li>
    <li><strong>Assigned User:</strong> {{ $lead->assigned_user ?? '-' }}</li>
</ul>
