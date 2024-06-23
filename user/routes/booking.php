<?php
session_start();

require '../../connect.php';

// // Retrieve package ID and name from query string
// $package_id = isset($_GET['package_id']) ? $_GET['package_id'] : '';
// $package_name = isset($_GET['package_name']) ? urldecode($_GET['package_name']) : '';


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve form data
    $destination = $_POST["package_id"];
    $date = $_POST["packageAvailable_id"];
    $participants = $_POST["num_people"];
    $package_cost = $_POST["package_cost"];

    // Prepare SQL statement to insert data into the database
    $sql = "INSERT INTO bookings (package_id, num_people, PackageAvailable_id, package_cost) 
            VALUES ('$destination', '$participants', '$date', '$package_cost')";

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
        <form action="" method="POST">
        <div class="form-group">
                <label for="destination">Destination:</label>
                <input type="text" id="destination" name="package_id" value="<?php echo $package_id; ?>" required readonly>
            </div>
            <div class="form-group">
                <label for="date">Available Dates:</label>
                <select id="date" name="packageAvailable_id" required>
                    <option value="2024-04-19">April 19, 2024</option>
                    <option value="2024-04-20">April 20, 2024</option>
                    <option value="2024-04-21">April 21, 2024</option>
                    <!-- Add more options for available dates -->
                </select>
            </div>
            <div class="form-group">
                <label for="participants">Number of Participants:</label>
                <input type="number" id="participants" name="num_people" min="1" value="1" required oninput="updatePrice()">
            </div>
            <div class="form-group">
                <label>Trek or Hike Package:</label>
                <p id="total-price">$2000</p>
                <input type="hidden" id="package_cost" name="package_cost" value="2000">
            </div>
            <div class="form-group">
                <label for="preferences">Special Preferences or Comments:</label>
                <textarea id="preferences" name="preferences" rows="4"></textarea>
            </div>
            <button type="submit">Book Now</button>
        </form>
    </div>
    <script>
        function updatePrice() {
            const basePrice = 2000;
            const participants = parseInt(document.getElementById('participants').value, 10) || 1;
            const totalPrice = basePrice * participants;
            document.getElementById('total-price').innerText = "$" + totalPrice;
            document.getElementById('package_cost').value = totalPrice;
        }
    </script>

</body>

</html>
