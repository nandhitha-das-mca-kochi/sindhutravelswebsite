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
// $customerId = $_POST['customer_id'];
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
        echo "<script>alert('booking successfully');
        window.location.href='dbmsconfirmation.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
