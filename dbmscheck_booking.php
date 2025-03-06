<?php
include 'dbconnect.php'; // Database connection

$bookingData = null;
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['customer_id'])) {
    $customer_id = intval($_POST['customer_id']); // Get the customer ID from input

    // Fetch booking details from the database
    $query = "SELECT * FROM booking_form WHERE customer_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $bookingData = $result->fetch_assoc(); // Fetch booking data
    } else {
        $errorMessage = "No booking found for this ID.";
    }
}

// Handle cancel booking
if (isset($_POST['cancel_booking']) && isset($_POST['customer_id'])) {
    $customer_id = intval($_POST['customer_id']);
    $deleteQuery = "DELETE FROM booking_form WHERE customer_id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $customer_id);

    if ($stmt->execute()) {
        $errorMessage = "Booking Cancelled Successfully!";
        $bookingData = null; // Clear booking data
    } else {
        $errorMessage = "Error cancelling booking.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Booking Details</title>
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
    </style>
</head>
<body>
<div class="container text-center">
    <h3 class="text-dark">Check Your Booking Details</h3>
    <form method="post">
        <label for="customer_id" class="form-label">Enter Your Customer ID</label>
        <input type="number" class="form-control mb-2" name="customer_id" required>
        <button type="submit" class="btn btn-success">Check Details</button>
    </form>

    <?php if ($errorMessage): ?>
        <p class="text-danger mt-3"><?= $errorMessage; ?></p>
    <?php endif; ?>

    <?php if ($bookingData): ?>
        <div class="mt-4">
            <h4 class="text-success">Your Booking Details</h4>
            <p><strong>Customer ID:</strong> <?= $bookingData['customer_id']; ?></p>
            <p><strong>Name:</strong> <?= $bookingData['name']; ?></p>
            <p><strong>Email:</strong> <?= $bookingData['email']; ?></p>
            <p><strong>Phone:</strong> <?= $bookingData['phone']; ?></p>
            <p><strong>From:</strong> <?= $bookingData['from']; ?></p>
            <p><strong>To:</strong> <?= $bookingData['to']; ?></p>
            <p><strong>Depart Date:</strong> <?= $bookingData['depart']; ?></p>
            <p><strong>Return Date:</strong> <?= $bookingData['return']; ?></p>
            <p><strong>Van Type:</strong> <?= $bookingData['vanType']; ?></p>
            <p><strong>Number of Persons:</strong> <?= $bookingData['persons']; ?></p>

            <!-- Buttons -->
            <form method="post">
                <input type="hidden" name="customer_id" value="<?= $bookingData['customer_id']; ?>">
                <button type="submit" name="cancel_booking" class="btn btn-danger">Cancel Booking</button>
                <a href="modify.php?customer_id=<?= $bookingData['customer_id']; ?>" class="btn btn-warning">Modify Booking</a>
                <a href="dbmshome.php" class="btn btn-primary">Go to Home</a>
            </form>
        </div>
    <?php endif; ?>
</div>
</body>
</html>