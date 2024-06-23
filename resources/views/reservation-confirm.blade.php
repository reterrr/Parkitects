<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #4CAF50;
        }
        p {
            line-height: 1.6;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #dddddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            color: #ffffff;
            background-color: #4CAF50;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Reservation Details</h1>
    <p>Dear User,</p>
    <p>Thank you for your reservation. Here are the details:</p>

    <table>
        <tr>
            <th>Parking ID</th>
            <td>{{ $parking_id }}</td>
        </tr>
        <tr>
            <th>Parking Place ID</th>
            <td>{{ $parking_place }}</td>
        </tr>
        <tr>
            <th>Start Time</th>
            <td>{{ $start_time }}</td>
        </tr>
        <tr>
            <th>End Time</th>
            <td>{{ $end_time }}</td>
        </tr>
    </table>

    <p>We look forward to serving you.</p>

    <p>Best regards,</p>
    <p>Your Company Name</p>

    <a href="#" class="button">View Your Reservation</a>
</div>
</body>
</html>
