<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Car Rental Confirmation</title>
</head>
<body>
    <h1>New Car Rental Booking</h1>

    <p>Dear Admin,</p>

    <p>A new car rental has been booked by a customer.</p>

    <h3>Rental Details:</h3>
    <p><strong>Customer Name:</strong> {{ $user_name }}</p>
    <p><strong>Car Name:</strong> {{ $car_name }}</p>
    <p><strong>Car Brand:</strong> {{ $car_brand }}</p>
    <p><strong>Rental Period:</strong> {{ $rental->start_date }} to {{ $rental->end_date }}</p>
    <p><strong>Total Cost:</strong> ৳{{ number_format($rental->total_cost, 2) }}</p>

    <p>Thank you, <br> Car Rental Team</p>
</body>
</html>
