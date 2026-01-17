<!DOCTYPE html>
<html>
<head>
    <title>Schedule Interview Feedback Emails</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"   >
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
        }
        .container {
            width: 500px;
            margin: 50px auto;
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,.1);
        }
        label {
            font-weight: bold;
            margin-top: 15px;
            display: block;
        }
        input, select, button {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }
        button {
            background: #0d6efd;
            color: white;
            border: none;
            margin-top: 20px;
            cursor: pointer;
        }
        button:hover {
            background: #084298;
        }
        .success {
            color: green;
            margin-bottom: 10px;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Schedule Feedback Email</h2>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('/schedule-feedback-emails') }}">
        @csrf

        <label>HR Email</label>
        <input type="email" name="email" required>

        <label>HR Name</label>
        <input type="text" name="hr_name" required>

        <label>Start Date & Time</label>
        <input type="datetime-local" name="start_date" required>

        <label>End Date & Time</label>
        <input type="datetime-local" name="end_date" required>

        <label>Interval</label>
        <select name="interval" required>
    @php
        $intervals = [1,2,3,5,10,15,20,30,60,120,180,240,360,1440];
    @endphp

    @foreach($intervals as $minutes)
        <option value="{{ $minutes }}">
            @if ($minutes < 60)
                Every {{ $minutes }} minute{{ $minutes > 1 ? 's' : '' }}
            @elseif ($minutes == 60)
                Every 1 hour
            @elseif ($minutes % 60 == 0)
                Every {{ $minutes / 60 }} hours
            @else
                Every {{ $minutes }} minutes
            @endif
        </option>
    @endforeach
</select>

        <button type="submit">Schedule Emails</button>
    </form>
</div>

</body>
</html>
