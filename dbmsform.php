<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: rgb(34, 192, 87);
        }
        .container {
            max-width: 600px;
            margin-top: 30px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .error {
            color: red;
            font-size: 14px;
            display: none;
        }
    </style>
</head>
<body>
<?php include 'dbconnect.php'; 
?>
<div class="container">
    <h3 class="text-center">NANCY BOOKING FORM</h3>
    <form id="bookingForm" action="connect.php" method="POST">
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
            <small class="error" id="error-name">Please fill this field</small>
        </div>
        <div class="mb-3">
            <label class="form-label">Email ID</label>
            <input type="email" class="form-control" id="email" name="email" required>
            <small class="error" id="error-email">Please fill this field</small>
        </div>
        <div class="mb-3">
            <label class="form-label">Phone Number</label>
            <input type="tel" class="form-control" id="phone" name="phone" required>
            <small class="error" id="error-phone">Please fill this field</small>
        </div>
        <div class="mb-3">
            <label class="form-label">From</label>
            <input type="text" class="form-control" id="from" name="from" required>
            <small class="error" id="error-from">Please fill this field</small>
        </div>
        <div class="mb-3">
            <label class="form-label">To</label>
            <input type="text" class="form-control" id="to" name="to" required>
            <small class="error" id="error-to">Please fill this field</small>
        </div>
        <div class="mb-3">
            <label class="form-label">Depart Date</label>
            <input type="date" class="form-control" id="depart" name="depart" required>
            <small class="error" id="error-depart">Please fill this field</small>
        </div>
        <div class="mb-3">
            <label class="form-label">Return Date</label>
            <input type="date" class="form-control" id="return" name="return" required>
            <small class="error" id="error-return">Please fill this field</small>
        </div>
        <div class="mb-3">
            <label class="form-label">Van Type</label>
            <select class="form-control" id="vanType" name="vanType" required>
                <option value="" selected>Select Van Type</option>
                <option value="Standard">Standard</option>
                <option value="Luxury">Luxury</option>
                <option value="Mini Bus">Mini Bus</option>
            </select>
            <small class="error" id="error-vanType">Please fill this field</small>
        </div>
        <div class="mb-3">
            <label class="form-label">Number of Persons</label>
            <input type="number" class="form-control" id="persons"  name="persons" min="1" required>
            <small class="error" id="error-persons">Please fill this field</small>
        </div>
        <div class="d-flex justify-content-between">
            <button type="reset" class="btn" style="background-color:rgb(34, 192, 87);" onclick="resetErrors()">Reset</button>
            <button type="submit" class="btn" style="background-color:rgb(34, 192, 87);" windows.href="dbmsconfirmation.php">Confirm Booking</button>
            <input type="hidden" id="customer_id" name="customer_id" required>
        </div>
    </form>
</div>

<script>
    function confirmBooking() {
    let fields = ["name", "email", "phone", "from", "to", "depart", "return", "vanType", "persons"];
    let valid = true;
    let bookingData = {};

    fields.forEach(field => {
        let input = document.getElementById(field);
        let error = document.getElementById("error-" + field);

        if (!input.value.trim()) {
            error.style.display = "block"; 
            valid = false;
        } else {
            error.style.display = "none"; 
            bookingData[field] = input.value; 
        }
    });

    if (valid) {
        localStorage.setItem("bookingData", JSON.stringify(bookingData));
        window.location.href = "dbmsconfirmation.php"; 
    }
}

function resetErrors() {
    let errors = document.querySelectorAll(".error");
    errors.forEach(error => {
        error.style.display = "none"; 
    });
}

</script>

</body>
</html>
