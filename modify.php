<?php
include 'dbconnect.php'; // Database connection

$bookingData = null;
$errorMessage = "";
$successMessage = "";

// Check if customer_id is provided in URL
if (isset($_GET['customer_id'])) {
    $customer_id = intval($_GET['customer_id']);

    // Fetch booking details
    $query = "SELECT * FROM booking_form WHERE customer_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $bookingData = $result->fetch_assoc();
    } else {
        $errorMessage = "No booking found for this ID.";
    }
}

// Handle form submission for updating booking details
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_booking'])) {
    $customer_id = intval($_POST['customer_id']);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $from = $_POST['from'];
    $to = $_POST['to'];
    $depart = $_POST['depart'];
    $return = $_POST['return'];
    $vanType = $_POST['vanType'];
    $persons = intval($_POST['persons']);

    // Update query
    $updateQuery = "UPDATE booking_form SET name=?, email=?, phone=?, `from`=?, `to`=?, depart=?, `return`=?, vanType=?, persons=? WHERE customer_id=?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssssssssii", $name, $email, $phone, $from, $to, $depart, $return, $vanType, $persons, $customer_id);

    if ($stmt->execute()) {
        echo "<script>
                alert('Booking Updated Successfully!');
                window.location.href = 'dbmshome.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Error updating booking.');
              </script>";
    }
    
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Booking</title>
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
<div class="container">
    <h3 class="text-center text-dark">Modify Booking</h3>

    <?php if ($errorMessage): ?>
        <p class="text-danger"><?= $errorMessage; ?></p>
    <?php endif; ?>

    <?php if ($bookingData): ?>
        <form method="post">
            <input type="hidden" name="customer_id" value="<?= $bookingData['customer_id']; ?>">

            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="<?= $bookingData['name']; ?>" required>

            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="<?= $bookingData['email']; ?>" required>

            <label class="form-label">Phone</label>
            <input type="text" class="form-control" name="phone" value="<?= $bookingData['phone']; ?>" required>

            <label class="form-label">From</label>
            <input type="text" class="form-control" name="from" value="<?= $bookingData['from']; ?>" required>

            <label class="form-label">To</label>
            <input type="text" class="form-control" name="to" value="<?= $bookingData['to']; ?>" required>

            <label class="form-label">Depart Date</label>
            <input type="date" class="form-control" name="depart" value="<?= $bookingData['depart']; ?>" required>

            <label class="form-label">Return Date</label>
            <input type="date" class="form-control" name="return" value="<?= $bookingData['return']; ?>" required>
            <br>
            <label class="form-label">Van Type</label>
            <select name="vanType" required>
            <option  value="Standard" <?= ($bookingData['vanType'] == 'Standard') ? 'selected' : ''; ?>>Standard</option>
            <option value="Luxury" <?= ($bookingData['vanType'] == 'Luxury') ? 'selected' : ''; ?>>Luxury</option>
            <option value="Mini" <?= ($bookingData['vanType'] == 'Mini') ? 'selected' : ''; ?>>Mini</option>
            </select>
            <br>
            <label class="form-label">Number of Persons</label>
            <input type="number" class="form-control" name="persons" value="<?= $bookingData['persons']; ?>" required>

            <button type="submit" name="update_booking" class="btn btn-success mt-3">Update Booking</button>
            <a href="dbms_checkbooking.php?customer_id=<?= $bookingData['customer_id']; ?>" class="btn btn-secondary mt-3" windows.location.href="dbmscheck_booking.php">Back</a>
        </form>
    <?php endif; ?>
</div>
</body>
</html>