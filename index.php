<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $frm = $_POST['frm'];
    $destination = $_POST['destination'];
    $travel_date = $_POST['travel_date'];
    $adult= $_POST['adult'];

    $sql = "INSERT INTO bookings (name, email, phone, frm, destination, travel_date, adult) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $name, $email, $phone, $frm, $destination, $travel_date, $adult);

    if ($stmt->execute()) {
        $success = "Booking successfully registered!";
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tour Travels Booking</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1>Book Your Travel</h1>
        <?php if(isset($success)) echo "<p class='success'>$success</p>"; ?>
        <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST" action="">
            
            <div class="input-wrapper">
               <i class="fa-solid fa-user"></i>
               <input type="text" id="name" name="name" placeholder="Name" required>
            </div>

           
            <div class="input-wrapper">
               <i class="fa-solid fa-envelope"></i>
               <input type="email" id="email" name="email" placeholder="Email" required>
            </div>

            
            <div class="input-wrapper">
              <i class="fa-solid fa-phone"></i>
              <input type="tel" id="phone" name="phone" placeholder="Phone" required>
            </div>

         
            <div class="input-wrapper">
                <i class="fa-solid fa-location-pin"></i>
                <input type="text" id="frm" name="frm" placeholder="From" required>
            </div>

          
            <div class="input-wrapper">
                <i class="fa-solid fa-location-dot"></i>
                <input type="text" id="destination" name="destination" placeholder="Destination" required>
            </div>

            
            <input type="date" id="travel_date" name="travel_date" placeholder="Travel Date"required>

            
            <div class="input-wrapper">
               <i class="fa-solid fa-person"></i>
               <input id="adult" name="adult" placeholder="1 Adult" required>
            </div>

            <input type="submit" value="Book Now">
        </form>
    </div>
</body>
</html>
