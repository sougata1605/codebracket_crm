<p>Dear {{ $lead->name }},</p>

<p>
    This is a <strong>computer generated acknowledgement</strong> to confirm that
    you have successfully submitted the lead form with the following details:
</p>

<ul>
    <li><strong>Name:</strong> {{ $lead->name }}</li>
    <li><strong>Email:</strong> {{ $lead->email }}</li>
    <li><strong>Phone:</strong> {{ $lead->phone }}</li>
    <li><strong>Enquiry For:</strong> {{ $lead->enquiry_for ?? '-' }}</li>
    <li><strong>Lead Type:</strong> {{ $lead->lead_type }}</li>
    <li><strong>Status:</strong> {{ $lead->status }}</li>
    <li><strong>Date:</strong> {{ $lead->lead_given_date }}</li>
</ul>

<p>
    Our team will contact you shortly.
</p>

<p>
    Regards,<br>
    <strong>Codebrackets Team</strong>
</p>
