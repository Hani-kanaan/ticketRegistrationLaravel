<!DOCTYPE html>
<html>
<head>
    <title>Flight Reminder</title>
</head>
<body>
    <h1>Flight Reminder</h1>
    <p>Dear {{ $passenger->name }},</p>
    <p>flight: {{ $flight->number }} is scheduled to depart from {{ $flight->departure_city }} to {{ $flight->arrival_city }} on {{ $flight->departure_time }}.</p>
</body>
</html>