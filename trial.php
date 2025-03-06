<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: rgb(34, 192, 87);
        }
        .container {
            max-width: 600px;
            margin-top: 30px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        #bookingDetails {
            display: block;
        }
        #cancelMessage {
            display: none;
            color: red;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>
<?php include 'dbconnect.php'; ?>
<div class="container text-center">
    <h3 class="text-success">Booking Confirmed!</h3>
    <p>Your booking has been successfully confirmed. Below are your details:</p>

    <div id="bookingDetails" class="text-start">
        <p><strong>Your ID:</strong> <span id="customerId"></span></p>
        <p><strong>Name:</strong> <span id="name"></span></p>
        <p><strong>Email:</strong> <span id="email"></span></p>
        <p><strong>Phone:</strong> <span id="phone"></span></p>
        <p><strong>From:</strong> <span id="from"></span></p>
        <p><strong>To:</strong> <span id="to"></span></p>
        <p><strong>Depart Date:</strong> <span id="depart"></span></p>
        <p><strong>Return Date:</strong> <span id="return"></span></p>
        <p><strong>Van Type:</strong> <span id="vanType"></span></p>
        <p><strong>Number of Persons:</strong> <span id="persons"></span></p>
        <button class="btn" mt-3 style="background-color: rgb(34, 192, 87);"" onclick="cancelBooking()">If You Want To Cancle Your Booking Click Here</button>
    </div>
    

    <p id="cancelMessage">Your booking has been cancelled.</p>
</div>

<script>
    // Load stored data from localStorage
    function loadBookingDetails() {
        let bookingData = JSON.parse(localStorage.getItem("bookingData"));

        if (!bookingData) {
            document.getElementById("bookingDetails").innerHTML = "<p class='text-danger'>No booking found.</p>";
            return;
        }

        // Generate a random 6-digit Customer ID
        let customerId = "CUST" + Math.floor(100000 + Math.random() * 900000);
        document.getElementById("customerId").textContent = customerId;
        
        // Fill in the details
        document.getElementById("name").textContent = bookingData.name;
        document.getElementById("email").textContent = bookingData.email;
        document.getElementById("phone").textContent = bookingData.phone;
        document.getElementById("from").textContent = bookingData.from;
        document.getElementById("to").textContent = bookingData.to;
        document.getElementById("depart").textContent = bookingData.depart;
        document.getElementById("return").textContent = bookingData.return;
        document.getElementById("vanType").textContent = bookingData.vanType;
        document.getElementById("persons").textContent = bookingData.persons;
    }

    // Cancel Booking
    function cancelBooking() {
        localStorage.removeItem("bookingData"); // Remove booking data
        document.getElementById("bookingDetails").style.display = "none"; // Hide booking details
        document.getElementById("cancelMessage").style.display = "block"; // Show cancel message
    }

    // Load booking details when page loads
    window.onload = loadBookingDetails;

</script>

</body>
</html> -->




<?php
$host = "localhost";  
$user = "root";       
$pass = "";           
$dbname = "tours_db";  

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 if ($_SERVER["REQUEST_METHOD"]=="POST"){
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$from = $_POST['from'];
$to = $_POST['to'];
$depart = $_POST['depart'];   
$return = $_POST['return'];   
$vanType = $_POST['vanType']; 
$persons = (int)$_POST['persons']; 
 

    // Use backticks (` `) for reserved keywords `from` and `to`
    $stmt = $conn->prepare("INSERT INTO booking_form(name, email, phone, `from`, `to`, depart, `return`, vanType, persons)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    // Fixing data types: Strings (s), Dates (s), Integer (i)
    $stmt->bind_param("ssssssssi", $name, $email, $phone, $from, $to, $depart, $return, $vanType, $persons);

    if ($stmt->execute()) {
        echo "Booking successfully recorded!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?> 
