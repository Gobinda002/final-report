<?php

require'../../connect.php';
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Retrieve form data
    $destination = $_POST["destination"];
    $date = $_POST["date"];
    $participants = $_POST["participants"];
    $package = $_POST["package"];
    $preferences = $_POST["preferences"];

 

    // Prepare SQL statement to insert data into the database (replace placeholders with actual table name and column names)
    $sql = "INSERT INTO bookings (destination, date, participants, package, preferences) 
            VALUES ('$destination', '$date', '$participants', '$package', '$preferences')";

    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "Booking successful! Thank you for booking with us.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close database connection
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Booking</title>
    <link rel="stylesheet" href="../public/CSS/booking.css">
</head>

<body>


    <div class="container">
        <h1>Book Your Trek or Hike</h1>
        <form action="booking_process.php" method="POST">
            <div class="form-group">
                <label for="destination">Destination:</label>
                <input type="text" id="destination" name="destination" required>
            </div>
            <div class="form-group">
                <label for="date">Available Dates:</label>
                <select id="date" name="date" required>
                    <option value="2024-04-19">April 19, 2024</option>
                    <option value="2024-04-20">April 20, 2024</option>
                    <option value="2024-04-21">April 21, 2024</option>
                    <!-- Add more options for available dates -->
                </select>
            </div>
            <div class="form-group">
                <label for="participants">Number of Participants:</label>
                <input type="number" id="participants" name="participants" min="1" required>
            </div>
            <div class="form-group">
                <label>Trek or Hike Package:</label>
                <p>$100</p>
                <input type="hidden" name="package" value="standard">
            </div>
            <div class="form-group">
                <label for="preferences">Special Preferences or Comments:</label>
                <textarea id="preferences" name="preferences" rows="4"></textarea>
            </div>
            <button type="submit">Book Now</button>
        </form>
    </div>

</body>

</html>