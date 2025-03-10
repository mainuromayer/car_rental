<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
</head>
<body>
    <h1>Car Rental Booking Confirmation</h1>

    <p>Dear {{ $user_name }},</p>

    <p>Your car rental has been confirmed!</p>

    <h3>Rental Details:</h3>
    <p><strong>Car Name:</strong> {{ $car_name }}</p>
    <p><strong>Car Brand:</strong> {{ $car_brand }}</p>
    <p><strong>Rental Period:</strong> {{ $rental->start_date }} to {{ $rental->end_date }}</p>
    <p><strong>Total Cost:</strong> ৳{{ number_format($rental->total_cost, 2) }}</p>

    <p>Thank you for choosing our car rental service!</p>
    <p>Best regards, <br> Car Rental Team</p>
</body>
</html>
