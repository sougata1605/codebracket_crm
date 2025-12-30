<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>New Lead Notification</title>
<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-dWmlhLf9RIr3O0N0vF0cw0vUgh8xEoX+Vn3Q3a8B1Yv6n1f6QdLnmGZ5t9q1pZxR5E+w5aA6zK7YFZb+FhUJdg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    body {
        font-family: 'Helvetica Neue', Arial, sans-serif;
        background-color: #f5f7fa;
        margin: 0;
        padding: 0;
        color: #333;
    }
    .container {
        max-width: 600px;
        margin: 40px auto;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    .header {
        background: linear-gradient(90deg, #ff6a00, #ee0979);
        color: #ffffff;
        text-align: center;
        padding: 30px 20px;
        font-size: 24px;
        font-weight: bold;
    }
    .content {
        padding: 30px 25px;
        line-height: 1.6;
    }
    .content p {
        margin: 15px 0;
        font-size: 16px;
    }
    .lead-details {
        background-color: #fff0f5;
        border-radius: 8px;
        padding: 20px;
        margin: 20px 0;
    }
    .lead-details ul {
        list-style-type: none;
        padding: 0;
    }
    .lead-details li {
        padding: 10px 0;
        font-size: 16px;
    }
    .lead-details li i {
        color: #ee0979;
        margin-right: 8px;
        width: 18px;
        text-align: center;
    }
    .footer {
        text-align: center;
        padding: 20px;
        font-size: 14px;
        color: #888;
        background-color: #f5f7fa;
    }
</style>
</head>
<body>

<div class="container">
    <div class="header">
        <i class="fas fa-user-plus"></i> New Lead Entry
    </div>

    <div class="content">
        <p>A new lead has been submitted with the following details:</p>

        <div class="lead-details">
            <ul>
                <li><i class="fas fa-user"></i> <strong>Name:</strong> {{ $lead->name }}</li>
                <li><i class="fas fa-envelope"></i> <strong>Email:</strong> {{ $lead->email }}</li>
                <li><i class="fas fa-phone"></i> <strong>Phone:</strong> {{ $lead->phone }}</li>
                <li><i class="fas fa-question-circle"></i> <strong>Enquiry For:</strong> {{ $lead->enquiry_for ?? '-' }}</li>
                <li><i class="fas fa-tag"></i> <strong>Lead Type:</strong> {{ $lead->lead_type }}</li>
                <li><i class="fas fa-info-circle"></i> <strong>Status:</strong> {{ $lead->status }}</li>
                <li><i class="fas fa-calendar-alt"></i> <strong>Date:</strong> {{ $lead->lead_given_date }}</li>
                <li><i class="fas fa-user-check"></i> <strong>Assigned User:</strong> {{ $lead->assigned_user ?? '-' }}</li>
            </ul>
        </div>

        <p>
            Please follow up with this lead at the earliest convenience.
        </p>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} Codebrackets. All rights reserved.
    </div>
</div>

</body>
</html>
