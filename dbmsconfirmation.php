<?php
include 'dbconnect.php';  // Ensure database connection

// Fetch the latest booking details from the database
$query = "SELECT * FROM booking_form ORDER BY customer_id DESC LIMIT 1";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    $bookingData = $result->fetch_assoc();
} else {
    $bookingData = null;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: rgb(34, 192, 87); }
        .container {
            max-width: 600px;
            margin-top: 30px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        #cancelMessage { display: none; color: red; font-weight: bold; text-align: center; }
    </style>
</head>
<body>

<div class="container text-center">
    <h3 class="text-success">Booking Confirmed!</h3>
    <?php if ($bookingData): ?>
        <p>Your booking has been successfully confirmed. Below are your details:</p>
        <div class="text-start">
            <p><strong>Your ID:</strong> <?= $bookingData['customer_id'] ?></p>
            <!-- <p><strong>Name:</strong> <?= $bookingData['name'] ?></p>
            <p><strong>Email:</strong> <?= $bookingData['email'] ?></p>
            <p><strong>Phone:</strong> <?= $bookingData['phone'] ?></p>
            <p><strong>From:</strong> <?= $bookingData['from'] ?></p>
            <p><strong>To:</strong> <?= $bookingData['to'] ?></p>
            <p><strong>Depart Date:</strong> <?= $bookingData['depart'] ?></p>
            <p><strong>Return Date:</strong> <?= $bookingData['return'] ?></p>
            <p><strong>Van Type:</strong> <?= $bookingData['vanType'] ?></p>
            <p><strong>Number of Persons:</strong> <?= $bookingData['persons'] ?></p> -->
        </div>
    <?php else: ?>
        <p class='text-danger'>No booking found.</p>
    <?php endif; ?>
</div>
<div class="text-center mt-3">
    <a href="dbmshome.php" class="btn btn-primary">Go to Home</a>
</div>

</body>
</html>