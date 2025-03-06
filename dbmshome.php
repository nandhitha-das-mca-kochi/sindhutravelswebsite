<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NANSY Tours and Travels</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            width: 100%;
            background-image:url("./bgimagedbms.jpg") ;
            background-size: 300vw 100vh;
            background-repeat: no-repeat;
            object-fit: contain;
        }
        .header{
            height: 20%;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgb(34, 192, 87);
            border-bottom: 3px solid #000000;        
        }
        .container-fluid {
            background: #ffffffcc;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px #00000033;
        }
        h1{
            padding-top:50px ; 
            padding-bottom: 20px;  
            font-size: 25px;
            font-weight: bold;
            color: #2c3e50;
            font-family: Georgia, 'Times New Roman', Times, serif;
        }
        .btn {
            width: 300px;
            font-size: 1.2rem;
            margin: 10px;
        }
    </style>
</head>
<body>



<div class="header">
    <h1>NANSY Tours and Travels</h1>
</div>
    <div class="container-fluid">
        <button class="btn" style="background-color: rgb(34, 192, 87);" onclick="bookNow()">Book Now</button>
        <button class="btn" style="background-color: rgb(34, 192, 87);" onclick="checkBooking()">Check Your Booking Details</button>
    </div>

    <script>
        function bookNow() {
            window.location.href = "dbmsform.php"; 
        }

        function checkBooking() {
            window.location.href = "dbmscheck_booking.php";
        }
    </script>

</body>
</html>
